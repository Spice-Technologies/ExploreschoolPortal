<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Admin;
use App\Models\Klass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvStudentController extends Controller
{

    public function index()
    {
        $classes = Klass::all();
        return view('backend.students.bulkaddstudent', compact('classes'));
    }




    public function store(Request $req)
    {
      
        $req->validate([
            'class_id' => 'required',
        ]);
        // to generate password using random strings

        function secure_random_string()
        {
            $random_string = '';
            for ($i = 0; $i < 5; $i++) {
                $number = random_int(0, 36);
                $character = base_convert($number, 10, 36);
                $random_string .= $character;
            }

            return $random_string;
        }

        $stPwd = secure_random_string();

        // to generate reg number 
        $reg_number =    function($id)
        {
            $regNum = '';
            $uniqueId = str_pad($id, 4, '0', STR_PAD_LEFT);
            $date = date('y');
            $regNum = substr(Admin::AdminSchool()->school, 0, 3) . '\\' . $date . '\\' . $uniqueId;
            return $regNum;
        };

        $upload = Excel::import(new StudentImport($reg_number,  $stPwd, Admin::current_session(), Admin::AdminSchool(),  Admin::loggedInAdmin(), $req->class_id), $req->file);
        if ($upload) {
            return back()->with('msg', 'Import was successful');
        } else {
            return back()->with('msg', 'Please go through the excel sheet and make sure it is well formatted');
        }
    }
}
