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
use App\Models\StockMovementApproverAssignment;

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
     * RECEIVE
     */
    public function receivingIndex()
    {
        $movements = StockMovement::with(['user', 'level', 'items.item.kind', 'items.item.unit', 'items.item.supplier', 'approvals.user'])
            ->where('type', 'receive')
            ->latest('movement_date')
            ->latest('id')
            ->paginate(15);
        $this->attachApprovalState($movements);

        return view('pages.stock.movements.index', [
            'movements' => $movements, 
            'movementType' => 'receive'
        ]);
    }

    public function receiveForm()
    {
        $items = InventoryItem::with(['kind', 'unit', 'supplier'])->get();
        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $levels = Level::get();
        $uoms = UnitOfMeasurement::get();

        return view('pages.stock.receiving', compact('items', 'categories', 'levels', 'suppliers', 'uoms'));
    }

    public function receivingStore(Request $request)
    {
        $request->merge(['items' => collect($request->input('items', []))
            ->filter(fn ($item) => filled($item['item_name'] ?? null) || filled($item['quantity'] ?? null) || filled($item['remarks'] ?? null))
            ->values()->all()]);

        $validator = Validator::make($request->all(), [
            'receiving_no' => [
                'required',
                'string',
                'max:100',
                Rule::unique('stock_movement_headers', 'reference_no'),
            ],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'receiving_date' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.item_name' => ['required', 'integer', 'exists:inventory_items,id'],
            // 'items.*.category' => ['required', 'integer', 'exists:inventory_kinds,id'],
            // 'items.*.uom' => ['required', 'integer', 'exists:uoms,id'],
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
                'movement_date' => $data['receiving_date'],
                'type' => 'receive',
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

        $movements = StockMovement::with(['user', 'level', 'items.item.kind', 'items.item.unit', 'items.item.supplier', 'approvals.user'])
            ->where('type', 'receive')
            ->latest('movement_date')
            ->latest('id')
            ->paginate(15);
        $this->attachApprovalState($movements);

        return redirect()->route('surface.stock.receive.index')
            ->with('success', 'Stock received and inventory updated successfully.');
    }


    /**
     * ISSUANCE
     */

    public function issuanceIndex()
    {
        $movements = StockMovement::with([
                'user', 'level',
                'items.item.kind', 'items.item.unit', 'items.item.supplier', 'items.destinationLevel',
                'approvals.user'
            ])
            ->where('type', 'issuance')
            ->latest('movement_date')
            ->latest('id')
            ->paginate(15);
        $this->attachApprovalState($movements);

        return view('pages.stock.movements.index', ['movements' => $movements, 'movementType' => 'issuance']);
    }

    private function attachApprovalState($movements): void
    {
        $assignments = StockMovementApproverAssignment::with('user')
            ->orderBy('approver_slot')
            ->get();

        $movements->getCollection()
            ->each(function ($movement) use ($assignments) {
                $approved = $movement
                    ->approvals
                    ->where('status', 'approved')
                    ->pluck('user_id');

                $pending = $assignments->first(fn ($a) => $a->user_id && !$approved->contains($a->user_id));
                $movement->setAttribute('pending_approver', $pending);
                $movement->setAttribute('can_approve', $movement->status === 'pending_approval' && (int) $pending?->user_id === (int) auth()->id());
        });
    }

    public function issuanceForm()
    {

        $items = InventoryItem::with([
            'kind',
            'unit',
            'supplier',
            'stock' => fn ($query) => $query
                ->where('location', 'surface')
                ->whereNull('level_id'),
        ])->get();
        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $levels = Level::get();
        $uoms = UnitOfMeasurement::get();

        return view('pages.stock.issuance', compact('items', 'categories', 'levels', 'suppliers', 'uoms'));
    }

    public function issuanceStore(Request $request)
    {
        $request->merge(['items' => collect($request->input('items', []))
            ->filter(fn ($item) => filled($item['item_name'] ?? null) || filled($item['quantity'] ?? null) || filled($item['remarks'] ?? null))
            ->values()->all()]);

        // 1. Validate Form Input
        $validated = $request->validate([
            'issuance_no' => ['required', 'string', 'max:100', Rule::unique('stock_movement_headers', 'reference_no')],
            'issuance_date' => ['required', 'date'],
            'level_id' => ['required', 'integer', 'exists:levels,id'],
            'items' => 'required|array',
            'items.*.item_name' => 'required|exists:inventory_items,id',
            'items.*.quantity'  => 'required|integer|min:1',
            'items.*.remarks'   => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($validated, $request) {
            // 2. Create Header Movement Entry
            $movement = StockMovement::create([
                'reference_no' => $validated['issuance_no'],
                'type' => 'issuance',
                'movement_date' => $validated['issuance_date'],
                'level_id' => $validated['level_id'],
                'user_id' => auth()->id(),
                'notes' => $request->notes ?? 'Surface to Underground Issuance',
            ]);

            foreach ($validated['items'] as $line) {
                $itemId  = $line['item_name'];
                $levelId = $validated['level_id'];
                $qty     = $line['quantity'];

                // A. Deduct Qty from Surface Stock
                $surfaceStock = InventoryStock::where('item_id', $itemId)
                    ->where('location', 'surface')
                    ->whereNull('level_id')
                    ->lockForUpdate()
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

        return redirect()->route('surface.stock.issuance.index')
            ->with('success', 'Underground issuance logged and stock updated successfully!');
    }
    
    /**
     * MOVEMENT
     */
    public function updateMovement(Request $request, StockMovement $movement)
    {
        abort_unless($movement->status === 'pending_approval', 403, 'Approved movements cannot be edited.');

        $data = $request->validate([
            'movement_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($movement, $data) {
            $oldItems = $movement->items()->get();
            foreach ($oldItems as $item) {
                $surface = InventoryStock::where('item_id', $item->item_id)
                    ->where('location', 'surface')->whereNull('level_id')->lockForUpdate()->first();
                if ($movement->type === 'receive') {
                    $surface?->decrement('quantity', $item->quantity);
                } else {
                    $surface?->increment('quantity', $item->quantity);
                    InventoryStock::where('item_id', $item->item_id)->where('location', 'underground')
                        ->where('level_id', $item->destination_level_id)->lockForUpdate()->first()?->decrement('quantity', $item->quantity);
                }
            }

            $movement->update(['movement_date' => $data['movement_date'], 'notes' => $data['notes'] ?? null]);
            foreach ($oldItems as $index => $item) {
                if (!isset($data['items'][$index])) continue;
                $line = $data['items'][$index];
                $item->update($line);
                $surface = InventoryStock::where('item_id', $item->item_id)->where('location', 'surface')
                    ->whereNull('level_id')->lockForUpdate()->firstOrFail();
                if ($movement->type === 'receive') {
                    $surface->increment('quantity', $line['quantity']);
                } else {
                    if ($surface->quantity < $line['quantity']) throw new \Exception('Insufficient surface stock.');
                    $surface->decrement('quantity', $line['quantity']);
                    InventoryStock::firstOrCreate([
                        'item_id' => $item->item_id, 'location' => 'underground', 'level_id' => $item->destination_level_id,
                    ], ['quantity' => 0])->increment('quantity', $line['quantity']);
                }
            }
        });
        return back()->with('success', 'Movement updated successfully.');
    }

    public function cancelMovement(StockMovement $movement)
    {
        abort_unless($movement->status === 'pending_approval', 403, 'This movement can no longer be cancelled.');

        $movement->update(['status' => 'cancelled']);

        return back()->with('success', 'Movement cancelled successfully.');
    }

    /**
     * WITHDRAWAL
     */
    public function withdrawal() {

        return view('pages.stock.withdrawal');
    }
    
    public function loadStockCard(string $id)
    {
        $stock = InventoryStock::with(['item', 'level'])->findOrFail($id);

        $movements = StockMovementItem::query()
            ->with(['movement', 'item.unit', 'item.kind'])
            ->where('item_id', $stock->item_id)
            ->where(function ($query) use ($stock) {
                $query->where(function ($q) use ($stock) {
                    $q->where('source_location', $stock->location)
                        ->where('source_level_id', $stock->level_id);
                })->orWhere(function ($q) use ($stock) {
                    $q->where('destination_location', $stock->location)
                        ->where('destination_level_id', $stock->level_id);
                });
            })
            ->get()
            ->sortBy(fn ($line) => [$line->movement->movement_date, $line->movement->id]);

        $entries = $movements->map(function ($line) use ($stock) {
            $isDestination = $line->destination_location === $stock->location
                && $line->destination_level_id == $stock->level_id;
            $isSource = $line->source_location === $stock->location
                && $line->source_level_id == $stock->level_id;
            // Receiving records use surface for both source and destination;
            // their header type identifies them as incoming stock.
            $incoming = ($isDestination && (!$isSource || $line->movement->type !== 'issuance'))
                ? (int) $line->quantity : 0;
            $outgoing = ($isSource && (!$isDestination || $line->movement->type === 'issuance'))
                ? (int) $line->quantity : 0;

            return [
                'date' => $line->movement->movement_date,
                'reference' => $line->movement->reference_no,
                'type' => $line->movement->type,
                'notes' => $line->remarks ?: $line->movement->notes,
                'incoming' => $incoming,
                'outgoing' => $outgoing,
                'uom' => $line->item?->unit?->unit,
            ];
        })->values();

        $opening = (int) $stock->quantity - $entries->sum('incoming') + $entries->sum('outgoing');
        $balance = $opening;
        $rows = $entries->groupBy('date')->map(function ($dayEntries, $date) use (&$balance) {
            $beginning = $balance;
            $incoming = $dayEntries->sum('incoming');
            $outgoing = $dayEntries->sum('outgoing');
            $balance += $incoming - $outgoing;

            return [
                'date' => $date,
                'beginning' => $beginning,
                'incoming' => $incoming,
                'outgoing' => $outgoing,
                'ending' => $balance,
                'uom' => $dayEntries->first()['uom'],
            ];
        })->values();

        return response()->json([
            'stock' => $stock,
            'stock_card' => $rows,
        ]);
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
}
