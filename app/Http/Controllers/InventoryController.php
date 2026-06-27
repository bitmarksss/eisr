<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\UploadedFile;
use App\Services\UploadExcelService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // Start building the query without executing it yet
        $inventory_items = Inventory::query()
            ->when($request->filled('category_filter'), function ($query) use ($request) {
                // Assuming 'category_id' is the column name in your database
                $query->where('category', $request->category_filter);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                // Assuming you want to search by item name or description
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get(); // Finally, execute the query and get the results

        $categories = Inventory::select('category')
            ->distinct()
            ->get();
            
        return view('pages.inventory.index', compact('inventory_items' ,'categories'));
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

    public function store(Request $request) 
    {
        // 1. Validate fields against incoming modal input names
        $request->validate([
            'sku'      => 'required|string|max:255|unique:inventory,sku',
            'name'     => 'required|string|max:255',
            'category' => 'required|string|in:Mechanical,Hydraulics,Electrical',
            'quantity' => 'required|integer|min:0',
        ]);

        // 2. Persist data via Mass Assignment using your fillable array
        Inventory::create([
            'sku'      => $request->sku,
            'name'     => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);

        // 3. Redirect back to the index with a clean success message flash
        return redirect()->route('inventory.index')
            ->with('success', "Inventory record [{$request->sku}] created successfully!");
    }

    public function update(Request $request, $id) 
    {
        // 1. Locate the item or throw a 404 if it doesn't exist
        $item = Inventory::findOrFail($id);

        // 2. Validate fields, ensuring the unique SKU rule ignores this specific item's ID
        $request->validate([
            'sku'      => 'required|string|max:255|unique:inventory,sku,' . $item->id,
            'name'     => 'required|string|max:255',
            'category' => 'required|string|in:Mechanical,Hydraulics,Electrical',
            'quantity' => 'required|integer|min:0',
        ]);

        // 3. Update the fields safely
        $item->update([
            'sku'      => $request->sku,
            'name'     => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('inventory.index')
            ->with('success', "Inventory item [{$request->sku}] has been successfully updated!");
    }

    public function add(Request $request) {
        
    }

    public function delete($id) {
        
    }
}