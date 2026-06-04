<?php

namespace App\Imports;

use App\Models\GroceryItem;
use Maatwebsite\Excel\Concerns\ToModel;

class GroceryItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GroceryItem([
            //
        ]);
    }
}
