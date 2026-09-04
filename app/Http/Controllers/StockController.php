<?php

namespace App\Http\Controllers;

use App\Models\{
    ActivityLog, 

    InventoryItem, 
    InventoryKind, 
    InventoryStock, 
    Level,
    Stock,
    StockMovement,
    StockMovementItem,
    Supplier, 
    UploadedFile, 
    UnitOfMeasurement
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StockController extends Controller
{
    /**
     * Display a listing of the stock requests.
     */
    public function index(Request $request)
    {
        $location = $request->segment(1) ?? null; // Default to 'empty' if not provided

        $stocks = InventoryStock::query()

            // Filter stocks backed on location
            ->when(($location), function ($query) use ($location) {
                $query->where('location', $location);
            })

            // If level filter is selected
            ->when(($request->filled('level_filter') && $location == 'underground'), function ($query) use ($request) {
                $query->where('level_id', $request->level_filter);
            })

            // Assuming you want to search by item name or description
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })

            // If category is selected for filtering
            ->when($request->filled('category_filter'), function ($query) use ($request) {
                $query->whereHas('item.kind', function ($q) use ($request) {
                    $q->where('id', $request->category_filter);
                });
            })

            ->with(['item', 'item.supplier', 'level'])
            // ->limit(10)
            ->get();

        $categories = InventoryKind::get();
        $levels = Level::get();
        $suppliers = Supplier::get();
        $uoms = UnitOfMeasurement::get();

        return view('pages.stock.index', compact('stocks' ,'categories', 'levels', 'suppliers', 'uoms', 'location'));
    }

    /**
     * Show the form for receiving a inventory stocks.
     */
    public function receive()
    {
        $stocks = InventoryStock::with(['level',
                'item',
                'item.kind',
                'item.variants',
                'item.unit'
            ])
            ->get();

        $items = InventoryItem::with(['kind', 'unit', 'supplier'])->get();
        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $levels = Level::get();
        $uoms = UnitOfMeasurement::get();

        return view('pages.stock.receiving', compact('items', 'categories', 'levels', 'stocks', 'suppliers', 'uoms'));
    }

    /**
     * Show the form for issuing a inventory stocks to underground levels.
     */
    public function issuance()
    {
        $stocks = InventoryStock::with(['item', 'level'])->get();

        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $levels = Level::get();
        $uoms = UnitOfMeasurement::get();

        return view('pages.stock.issuance', compact('categories', 'levels', 'stocks', 'suppliers', 'uoms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiving_no' => [
                'required',
                'string',
                'max:100',
                Rule::unique('stock_movements', 'reference_no'),
            ],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'receiving_date' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.item_name' => ['required', 'integer', 'exists:inventory_items,id'],
            'items.*.category' => ['required', 'integer', 'exists:inventory_kinds,id'],
            'items.*.uom' => ['required', 'integer', 'exists:uoms,id'],
            'items.*.remarks' => ['nullable', 'string', 'max:1000'],
        ]);
        if ($validator->fails()) {
            return back()
                ->with('notification', [
                    'status'   => 'error',
                    'title'    => 'Input Error',
                    'messages' => $validator->errors()->all(),
                ])
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
    
        DB::transaction(function () use ($data) {
            $movement = StockMovement::create([
                'reference_no' => $data['receiving_no'],
                'type' => 'adjustment',
                'user_id' => auth()->id(),
                'notes' => json_encode([
                    'transaction' => 'receiving',
                    'supplier_id' => $data['supplier_id'],
                    'receiving_date' => $data['receiving_date'],
                ]),
            ]);

            foreach ($data['items'] as $line) {
                $stock = InventoryStock::where('item_id', $line['item_name'])
                    ->where('location', 'surface')
                    ->whereNull('level_id')
                    ->lockForUpdate()
                    ->first();

                if ($stock) {
                    $stock->increment('quantity', $line['quantity']);
                } else {
                    InventoryStock::create([
                        'item_id' => $line['item_name'],
                        'location' => 'surface',
                        'level_id' => null,
                        'quantity' => $line['quantity'],
                    ]);
                }

                $movement->items()->create([
                    'item_id' => $line['item_name'],
                    'source_location' => 'surface',
                    'destination_location' => 'surface',
                    'quantity' => $line['quantity'],
                    'remarks' => $line['remarks'] ?? null,
                ]);
            }
        });

        return redirect()->route('surface.stock.index')
            ->with('success', 'Stock received and inventory updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logs(Request $request)
    {
        $location = $request->segment(1) ?? null; // Default to 'empty' if not provided

        // 1. Start with base query scoped tightly to our target model type
        $query = ActivityLog::with('user')
            // ->where('auditable_type', InventoryStock::class)
            ->latest('id'); // Order by newest logs first

        // 2. Filter by specific action (created, updated, deleted) if provided
        if ($request->filled('action_filter')) {
            $query->where('action', $request->action_filter);
        }

        // 3. Search filter handling (Checks user names, actions, or specific record IDs)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            
            $query->where(function ($q) use ($searchTerm) {
                $q->where('action', 'like', "%{$searchTerm}%")
                  ->orWhere('auditable_id', $searchTerm) // Exact numeric match for stock IDs
                  ->orWhere('ip_address', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // 4. Paginate results while preserving current query parameters
        $logs = $query->paginate(15)->withQueryString();

        // 5. Return the view with the required variables
        return view('pages.stock.logs', [
            'logs'     => $logs,
            'location' => $location,
        ]);
    }

    public function withdrawal() {

        return view('pages.stock.withdrawal');
    }

    // public function issuance(Request $request) {
    //     $location = $request->query('location', null); // Default to 'empty' if not provided

    //     if (!$location) {
    //         return view('pages.maintenance.error');
    //     }
    //     // Start building the query without executing it yet
    //     $inventory_items = InventoryItem::query()

    //         ->when(($request->filled('location') && $location != 'list'), function ($query) use ($location) {
    //             $query->whereHas('stock', function($q) use ($location) {
    //                 $q->where('location', $location);
    //             });
    //         })
            
    //         ->when($request->filled('category_filter'), function ($query) use ($request) {
    //             // Assuming 'category_id' is the column name in your database
    //             $query->whereHas('kind', function ($q) use ($request) {
    //                 $q->where('id', $request->category_filter);
    //             });
    //         })

    //         ->when($request->filled('search'), function ($query) use ($request) {
    //             // Assuming you want to search by item name or description
    //             $query->where('name', 'like', '%' . $request->search . '%');
    //         })

    //         ->with('kind')
    //         ->get();
        
    //     $categories = InventoryKind::get();
    //     $suppliers = Supplier::get();
    //     $uoms = UnitOfMeasurement::get();

    //     return view('pages.stock.issuance', compact('inventory_items' ,'categories', 'suppliers', 'uoms', 'location'));
    // }

    public function storeIssuance(Request $request)
    {
        // 1. Validate Form Input
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.item_name' => 'required|exists:inventory_items,id',
            'items.*.level_id'  => 'required|exists:levels,id',
            'items.*.quantity'  => 'required|integer|min:1',
            'items.*.remarks'   => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $request) {
            // 2. Create Header Movement Entry
            $movement = StockMovement::create([
                'reference_no' => 'ISS-' . strtoupper(Str::random(6)),
                'type' => 'issuance',
                'user_id' => auth()->id(),
                'notes' => $request->notes ?? 'Surface to Underground Issuance',
            ]);

            foreach ($validated['items'] as $line) {
                $itemId  = $line['item_name'];
                $levelId = $line['level_id'];
                $qty     = $line['quantity'];

                // A. Deduct Qty from Surface Stock
                $surfaceStock = InventoryStock::where('item_id', $itemId)
                    ->where('location', 'surface')
                    ->firstOrFail();

                if ($surfaceStock->quantity < $qty) {
                    throw new \Exception("Insufficient surface stock for Item ID: {$itemId}");
                }

                $surfaceStock->decrement('quantity', $qty);

                // B. Add/Increment Qty on Target Underground Level
                $undergroundStock = InventoryStock::firstOrCreate(
                    [
                        'item_id'  => $itemId,
                        'location' => 'underground',
                        'level_id' => $levelId,
                    ],
                    ['quantity' => 0]
                );

                $undergroundStock->increment('quantity', $qty);

                // C. Record Movement Line Item Log
                $movement->items()->create([
                    'item_id'                => $itemId,
                    'source_location'        => 'surface',
                    'source_level_id'        => null,
                    'destination_location'   => 'underground',
                    'destination_level_id'   => $levelId,
                    'quantity'               => $qty,
                    'remarks'                => $line['remarks'] ?? null,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Underground issuance logged and stock updated successfully!');
    }
}
