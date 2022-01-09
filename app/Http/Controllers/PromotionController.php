<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function index()
    {
        return view('backend.class.promote');
    }

    public function promote(Request  $request)
    {
        
        //check if there are ss3 students and move them to a new table
        $Student = new Student();

    
        $adminOwnStudents = $Student->SchoolId(Admin::AdminSchool())->get();
        //fetch all the students in the class but based on the admin and school he belongs to before promotion 
      
         $adminOwnStudents->where('class_id', 6)->each(function ($finalist) {
            $graduateStud = $finalist->replicate();
            $graduateStud->setTable('graduates');
            $graduateStud->save();
            $finalist->delete(); //delete the student from the old tbale (student)
        });

        $matches = collect([1, 2, 3, 4, 5]);
        //to avoid this stuff for repeating more than once in year, you will have to check for the session date in the database, against the current year, then fire the increment() stuff
        $adminOwnStudents->where('school_id', Admin::AdminSchool())->whereIn('class_id', $matches)->increment('class_id', 1);
        //$h->toSql(); using this to output raw sql queries
        return redirect()->route('student.index');
    }
}
