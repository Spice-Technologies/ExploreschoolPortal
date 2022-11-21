<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name' =>  $row['name'],
            'class_id' =>  $row['class_id'],
            'SubKlass_id' => $row['subclass_id'],
            'school_id' =>  1,
            
            'admin_id' =>  1,
            'gender' => $row['gender'],
            'dateofbirth' => $row['dateofbirth'],
            'lga' => $row['lga'],
            'state' => $row['state'],
            'country' => $row['country'],
            'permanent_address'  => $row['permanent_address'],
            'current_address' => $row['current_address'],
            'reg_num' => 
            
            
        ]);
    }
}
