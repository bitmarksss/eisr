<?php

namespace App\Imports;

use App\Models\PaymentItem;
use Maatwebsite\Excel\Concerns\ToModel;

class PaymentItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PaymentItem([
            //
        ]);
    }
}
