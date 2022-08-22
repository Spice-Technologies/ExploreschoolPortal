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

    private $studentInfor = [];

    public function __construct($class, $term, $session, $school)
    {
        $this->class = $class;
        $this->term = $term;
        $this->session = $session;
        $this->school = $school;
    
    }

    public function collection(collection $rows)
    {
        $array = $rows->toArray();

        $t = array_splice($array, 1);


        foreach ($t as $key => $row) {
            Result::updateOrCreate(
                ['RegNum' => $row[2]]
                ,

                [
                    'RegNum' => $row[2], 
                    'class_id' => $this->class,
                    'subject_id' => $row[4], // we will want to make sure this subject_id here is same with the id column for subjects in the subjectsTable !!!
                    'school_id' => $this->school, // school id is determinat from the admin himself 
                    'assessment_total' => $row[6],
                    'exam_score' => $row[7],
                    'total_score' => $row[7] + $row[6],
                    'session_id' =>  $this->session,
                    'term_id' => $this->term,
                    'subject' => $row[9],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    //my logic and approach

    //just get the student exam number,
    //use that number to get the other details like CLASS, SCHOOL, to be inserted into result table z

}
