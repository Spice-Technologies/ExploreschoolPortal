<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{

    public function index()
    {
        return view('backend.class.promote');
    }

    public function promote()

    {

        //check if there are ss3 students and move them to a new table
        $Student = new Student();

        $currentSession = Session::where('active', 1)->first();
        $adminOwnStudents = $Student->SchoolId(Admin::AdminSchool()->id)->get();
        //fetch all the students in the class but based on the admin and school he belongs to before promoting 

        $massPromote = DB::table('students')->where('school_id', Admin::AdminSchool()->id)->where('session_id', '!=',  $currentSession->id)->where('graduate_status', '!=', true)->lazyById();
        // this is approach is better otherway, I  could have use get() to get all the students first before updating them again to the DB--I believe it is not perfomance wise enough. 
        //th place where I had to use   $query->class_id = $query->class_id + 1; is what saved me.
        //when you want to think about it, assume that i used mass update ->update([]) method
        //for what I know , it will be difficulut to get the class to add or pluss with 1
        // dd($massPromote == true ? 'true' : 'false');
        if ($massPromote) {

            //promote normal students...
            $massPromote->each(function ($query) use ($currentSession) {

                $query->class_id = $query->class_id + 1;
                $query->current_session =   $currentSession->session;
                $query->session_id = $currentSession->id;
                $query->save();
            });

            return redirect()->route('student.index')->with('msg', 'Students promoted successfully');
        } else {
            //promote graduate
            $massPromote->update([
                'graduate_status' => 1,
                'current_session' =>  $currentSession->session,
                'session_id' => $currentSession->id
            ]);
            return redirect()->route('student.index')->with('msg', 'Students promoted successfully');
        }
    }
}
