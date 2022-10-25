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

        $adminOwnStudents = $Student->SchoolId(Admin::AdminSchool()->id)->get();
        //fetch all the students in the class but based on the admin and school he belongs to before promoting them

        $adminOwnStudents->where('class_id', 6)->each(function ($finalist) {
            $graduateStud = $finalist->replicate();
            $graduateStud->setTable('graduates');
            $graduateStud->save();
            $finalist->delete(); //delete the student from the old tbale (student)
        });

        $matches = collect([1, 2, 3, 4, 5]);

        // $adminOwnStudents->where('class_id', 7)->each(function ($finalist) use ($matches) {
        //     $finalist->class_id = $matches->shift();
        //     $finalist->save();
        // });

        $adminOwnStudents->where('school_id', Admin::AdminSchool()->id)
            ->whereIn('class_id', $matches)
            ->each(function ($stClass) {
                $stClass->class_id = $stClass->class_id + 1;
                $stClass->save();
            });
        //$h->toSql(); using this to output raw sql queries
        return redirect()->route('student.index')->with('msg', 'Students promoted successfully');
    }

    public function individualPromotionIndex()
    {
        return view('backend.promotion.promoteclass');

    }
}
