<?php

namespace App\Imports;

use App\Models\Result;
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

    public $studentInfor = [];

    public function whereRegNum($csvRegNo)
    {
        $data = Student::where('reg_num', $csvRegNo);

        array_push($this->studentInfor, collect($data)->toArray());
        //for everytime it loops through the excel rows, it returns the first/or it returns a single row
        return $data->exists() ? $data->first() : 'No student Record found';
    }
    //so I am trying to prevent the function regnum from being called multiple times instead, I push all the data into the StendInfo array then find the matching gone
    //and return it.

    // to make upload of result a little bit perfect to some extent, I will need to make sure that the admin selects the session he/she is uploading for
    //the term too

    //school need to be related with term...so at one point I know the term that class is or abi school 

    public function collection(collection $rows)
    {
        $array = $rows->toArray();

        $t = array_splice($array, 1);
   

        foreach ($t as $key => $row) {

            if ($this->whereRegNum($row[2]) != 'No student Record found') {
                dd($this->studentInfor);
                Result::updateOrCreate(
                    ['student_id' => $this->whereRegNum($row[2])], //I make the query once then push the result to an array so I avoid repeating them

                    [
                        'class_id' => $this->studentInfor[$key]['class_id'],
                        'subject_id' => $row[4], // we will want to make sure this subject_id here is same with the id column for subjects in the subjectsTable !!!
                        'school_id' => $this->studentInfor[$key]['school_id'],
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
            } else {
                dd('No record found ');
            }
        }
    }

    //my logic and approach

    //just get the student exam number,
    //use that number to get the other details like CLASS, SCHOOL, to be inserted into result table z

}
