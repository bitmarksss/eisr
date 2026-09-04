<?php

namespace App\Http\Controllers;

use App\Models\{
    InventoryItem, 
    InventoryKind, 
    Supplier, 
    UploadedFile, 
    UnitOfMeasurement
};
use App\Services\UploadExcelService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    public $uploadExcelService;
    public function __construct(UploadExcelService $uploadExcelService)
    {
        $this->uploadExcelService = $uploadExcelService;
    }

    /**
     * Display the file list with search and filters.
     */
    public function index(Request $request)
    {
        $location = $request->segment(1) ?? null; // Default to 'empty' if not provided

        // Start building the query without executing it yet
        $inventory_items = InventoryItem::query()

            // If category is selected for filtering
            ->when($request->filled('category_filter'), function ($query) use ($request) {
                $query->whereHas('kind', function ($q) use ($request) {
                    $q->where('id', $request->category_filter);
                });
            })

            // Assuming you want to search by item name or description
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->with(['kind'])
            ->orderBy('name', 'ASC')
            ->get();

        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $uoms = UnitOfMeasurement::get();
        // dd($uoms);

        return view('pages.inventory.index', compact('inventory_items' ,'categories', 'suppliers', 'uoms', 'location'));
    }

    public function store(Request $request) 
    {
        $data = $request->all();
        $categories = InventoryKind::pluck('id')->toArray();
        
        // 1. Validate fields against incoming modal input names
        $validated_data = Validator::make($data, [
            'supplier_id'   => 'required|exists:suppliers,id',
            'name'          => 'required|string|max:255',
            'item_code'     => 'required|string|max:255',
            'category'      => [
                'required', 
                'integer', 
                Rule::in($categories),
            ],
            'variant'       => 'required|string|max:255',
            'cost'          => 'required|numeric|decimal:0,2',
            'unit'          => 'required|exists:uoms,id',
        ]);

        if ($validated_data->fails()) {
            return back()
                ->with('notification', [
                    'status'   => 'error',
                    'title'    => 'Validation Error',
                    'messages' => $validated_data->errors()->messages(),
                ])
                ->withErrors($validated_data)
                ->withInput();
        }

        // 2. Persist data via Mass Assignment using your fillable array
        InventoryItem::create([
            'item_code'     => $request->item_code,
            'supplier_id'   => $request->supplier_id,
            'name'          => $request->name,
            'variant'       => $request->variant,
            'kind_id'       => $request->category,
            'cost'          => $request->cost,
            'uom'           => $request->unit,
        ]);

        // 3. Redirect back to the index with a clean success message flash
        return redirect()->route('maintenance.inventory.index')
            ->with('success', "Inventory record [{$request->item_code}] created successfully!");
    }

    public function update(Request $request, $id) 
    {
        // 1. Locate the item or throw a 404 if it doesn't exist
        $item = InventoryItem::findOrFail($id);

        // 2. Validate fields against incoming modal input names
        $data = $request->all();
        $categories = InventoryKind::pluck('id')->toArray();
        
        $validated_data = Validator::make($data, [
            'supplier_id'   => 'required|exists:suppliers,id',
            'name'          => 'required|string|max:255',
            'item_code'     => 'required|string|max:255',
            'category'      => [
                'required', 
                'integer', 
                Rule::in($categories),
            ],
            'variant'       => 'required|string|max:255',
            'cost'          => 'required|numeric|decimal:0,2',
            'unit'          => 'required|exists:uoms,id',
        ]);

        if ($validated_data->fails()) {
            return back()
                ->with('notification', [
                    'status'   => 'error',
                    'title'    => 'Validation Error',
                    'messages' => $validated_data->errors()->messages(),
                ])
                ->withErrors($validated_data)
                ->withInput();
        }

        // 3. Update the fields safely
        $item->update([
            'item_code'     => $request->item_code,
            'supplier_id'   => $request->supplier_id,
            'name'          => $request->name,
            'variant'       => $request->variant,
            'kind_id'       => $request->category,
            'cost'          => $request->cost,
            'uom'           => $request->unit,
        ]);

        return redirect()->route('maintenance.inventory.index')
            ->with('success', "Inventory item [{$request->item_code}] has been successfully updated!");
    }

    public function add(Request $request) {
        
    }

    public function delete($id) {
        
    }

    /**
     * Handle the Excel batch upload and process rows.
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        if ($validator->fails()) {
            return back()
                ->with('notification', [
                    'status'   => 'error',
                    'title'    => 'Validation Error',
                    'messages' => $validator->errors()->messages(),
                ])
                ->with('errors', $validator->errors()->all())
                ->withInput();
        }

        try {
            // Extract the file object explicitly out of the request payload
            $file = $request->file('excel_file');

            // Set the module type
            $module_type = 'inventory';

            // Service handles the heavy lifting and returns the tracking record
            $upload = $this->uploadExcelService->make($file, $module_type);

            return back()->with('success', "File \"{$upload->original_filename}\" uploaded and is processing in the background!");

        } catch (\Exception $e) {
            // Any structural bugs/failures gracefully fallback here
            return back()->with('errors', [$e->getMessage()]);
        }
    }

    public function update_record(Request $request, $item_id) 
    {
        // If you prefer a distinct page view instead of a modal:
        $item = InventoryItem::with('kind')->findOrFail($item_id);
        
        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $uoms = UnitOfMeasurement::get();
        
        // Pass along whatever data your layout expects (like $location, $categories, etc.)
        return view('inventory.update-record', compact('item', 'categories', 'suppliers', 'uoms'));
    }

    // Submit your tabular records here
    public function record(Request $request) 
    {
        $request->validate([
            'item_id' => 'required|exists:inventory_items,id',
            'kind'    => 'required|string|max:255',
            'logs'    => 'required|array|min:1',
            'logs.*.date'      => 'required|date',
            'logs.*.beginning' => 'required|numeric|min:0',
            'logs.*.incoming'  => 'required|numeric|min:0',
            'logs.*.outgoing'  => 'required|numeric|min:0',
            'logs.*.ending'    => 'required|numeric|min:0',
            'logs.*.uom'       => 'required|string|max:10',
        ]);

        $item = InventoryItem::findOrFail($request->item_id);

        // Loop through rows sent by your dynamic table form
        foreach ($request->logs as $log) {
            // Example: Save logs to an inventory_stock_cards table if tracked over time
            // $item->stockCards()->create($log);
        }

        // Capture the final 'ending' stock value from the last row to update main inventory quantity
        $lastLog = end($request->logs);
        $item->update([
            'quantity' => $lastLog['ending']
        ]);

        return redirect()->back()->with('success', 'Explosives Stock Card log entries recorded successfully!');
    }

    // FOR SURFACE AND UNDERGROUND
    public function warehouse_index(Request $request)
    {
        $location = $request->query('location', null); // Default to 'empty' if not provided

        // Start building the query without executing it yet
        $inventory_items = InventoryItem::query()

            // If location is selected for filtering
            ->with('stock')
            ->when(($request->filled('location') && $location != 'list'), function ($query) use ($location) {
                $query->whereHas('stock', function($q) use ($location) {
                    $q->where('location', $location);
                });
            })

            // If category is selected for filtering
            ->when($request->filled('category_filter'), function ($query) use ($request) {
                $query->whereHas('kind', function ($q) use ($request) {
                    $q->where('id', $request->category_filter);
                });
            })

            // Assuming you want to search by item name or description
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->with('kind')
            ->get();

        $kinds = InventoryKind::pluck('kind');
        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $uoms = UnitOfMeasurement::get();

        return view('pages.stock.index', compact('inventory_items' ,'kinds', 'categories', 'suppliers', 'uoms', 'location'));
    }

    public function withdrawal() {

        return view('inventory.withdrawal');
    }

    public function issuance() {

        return view('inventory.withdrawal');
    }
}