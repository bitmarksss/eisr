<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;

class SupplierController extends Controller
{
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
