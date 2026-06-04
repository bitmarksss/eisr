<?php

namespace App\Imports;

use App\Models\LoanItem;
use Maatwebsite\Excel\Concerns\ToModel;

class LoanItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new LoanItem([
            //
        ]);
    }
}
