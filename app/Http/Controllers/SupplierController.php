<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;

class SupplierController extends Controller
{
    public function supplierItems(Supplier $supplier)
{
    $items = $supplier->items()
        ->select('id', 'name', 'variant', 'kind_id', 'unit_id')
        ->get();

    return response()->json($items);
}
}
