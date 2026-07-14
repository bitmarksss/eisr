<?php

namespace App\Http\Controllers;

use App\Models\{
    InventoryItem, 
    InventoryKind, 
    Stock,
    Supplier, 
    UploadedFile, 
    UnitOfMeasurement
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StockController extends Controller
{
    /**
     * Display a listing of the stock requests.
     */
    public function index(Request $request)
    {
        // Capture the prefix context ('surface' or 'underground')
        $location = $request->segment(1) === 'underground' ? 'underground' : 'surface';

        $stock_requests = Stock::query()
            // Ensure you filter down by your location context if your table tracks it, 
            // or remove this line if stock requests are global across areas.
            // ->where('location', $location) 
            ->with(['uom', 'user'])
            ->when($request->filled('kind_filter'), function ($query) use ($request) {
                $query->where('kind', $request->kind_filter);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('type', 'like', '%' . $request->search . '%')
                    ->orWhere('kind', 'like', '%' . $request->search . '%')
                    ->orWhere('remarks', 'like', '%' . $request->search . '%');
                });
            })
            ->paginate(15); // Swapped to pagination to support .hasPages grid calls cleanly

        // Gather collections for modal select drop-downs
        $kinds = InventoryKind::pluck('kind');
        $suppliers = Supplier::get();
        $uoms = UnitOfMeasurement::get(); // Maps to $uoms collection variable
            
        return view('pages.stock.index', compact('stock_requests', 'kinds', 'suppliers', 'uoms', 'location'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function withdrawal() {

        return view('pages.stock.withdrawal');
    }

    public function issuance(Request $request) {
        $location = $request->query('location', null); // Default to 'empty' if not provided

        if (!$location) {
            return view('pages.maintenance.error');
        }

        // Start building the query without executing it yet
        $inventory_items = InventoryItem::query()
            ->when(($request->filled('location') && $location != 'list'), function ($query) use ($location) {
                $query->whereHas('stock', function($sub_query) use ($location) {
                    $sub_query->where('location', $location);
                });
            })
            // ->where('location', $location)
            ->when($request->filled('category_filter'), function ($query) use ($request) {
                // Assuming 'category_id' is the column name in your database
                $query->whereHas('kind', function ($q) use ($request) {
                    $q->where('id', $request->category_filter);
                });
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                // Assuming you want to search by item name or description
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->with('kind')
            ->get();
        
        $categories = InventoryKind::get();
        $suppliers = Supplier::get();
        $uoms = UnitOfMeasurement::get();

        dd($inventory_items);

        return view('pages.stock.issuance', compact('inventory_items' ,'categories', 'suppliers', 'uoms', 'location'));
    }
}
