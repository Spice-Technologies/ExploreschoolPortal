<?php

namespace App\Imports;

use App\Models\result;
use Maatwebsite\Excel\Concerns\ToModel;

class ResultsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new result([
            //
        ]);
    }
}
