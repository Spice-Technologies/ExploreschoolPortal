<?php

namespace App\Imports;

use App\Models\result;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ResultsImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public $studentInfo = [];

    public function whereRegNum($id)
    {
        $data = Student::where('reg_num', $id)->first();

        array_push($this->studentInfo, collect($data)->toArray());

        return $data;
    }
    //so I am tryitn to prevent the functioon regnum from being called multiple times instead, I push all the data into the StendInfo array then find the matchin gone
    //and return it.

    public function collection(collection $rows)
    {

        $array = $rows->toArray();
        $t = array_splice($array, 1);
        foreach ($t as $key => $row) {

            Result::updateOrCreate(
                ['student_id' => $this->whereRegNum($row[2])->id],

                [
                    'class_id' => $this->studentInfo[$key]['class_id'],
                    'subject_id' => $row[4],
                    'school_id' => $this->studentInfo[$key]['school_id'],
                    'assessment_total' => $row[6],
                    'exam_score' => $row[7],
                    'total_score' => $row[7] + $row[6],
                    'session_id' => 1,
                    'term_id' => 1,
                    'subject' => $row[9],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    //my logic and approach

    //just get the student exam number,
    //use that number to get the other details like CLASS, SCHOOL, to be inserted into result table 

}
