<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount('items')->orderBy('name')->paginate(15);

        return view('pages.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('pages.suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name',
        ]);

        Supplier::create($validated);

        return redirect()->route('maintenance.supplier.index')
            ->with('success', 'Supplier created successfully.');
    }

    public function edit(Supplier $supplier)
    {
        return view('pages.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name,' . $supplier->id,
        ]);

        $supplier->update($validated);

        return redirect()->route('maintenance.supplier.index')
            ->with('success', 'Supplier updated successfully.');
    }

    public function supplierItems(Supplier $supplier)
    {
        $items = $supplier->items()
            ->select('id', 'name', 'variant', 'kind_id', 'uom')
            ->with([
                'kind:id,kind',
                'unit:id,unit',
            ])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'variant' => $item->variant,
                    'kind' => $item->kind?->kind,
                    'unit' => $item->unit?->unit,
                ];
            });

        return response()->json($items);
    }
}
