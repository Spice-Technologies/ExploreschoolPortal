<?php

namespace App\Imports;

use App\Models\result;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class ResultsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public $studentInfo = [];

    public function whereRegNum($id)
    {
        $data = Student::where('reg_no', $id)->first();

        array_push($this->studentInfo, collect($data)->toArray());

        return $data;
    }
    //so I am tryitn to prevent the functioon regnum from being called multiple times instead, I push all the data into the StendInfo array then find the matchin gone
    //and return it.
    public function model(array $row)
    {
        return new result([
            $student_id = 'student_id' => $this->whereRegNum($row[3])->id,
            'class_id' => $this->studentInfo[$student_id]['class_id'],
            'subject_id' => $row[4],
        ]);
    }

    //my logic and approach

    //just get the student exam number,
    //use that number to get the other details like CLASS, SCHOOL, to be inserted into result table 

}
