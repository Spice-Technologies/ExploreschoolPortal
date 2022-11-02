<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;

class KlassPromotionController extends Controller
{
    public function index()
    {

        $currentSession = Session::where('active', 1)->first()->id;
       
        $loggedInAdmin =  Admin::loggedInAdmin();
        // constraint with eager loading . get the related model, student then add a condition to know make sure it get results where in the student table, row, the session_id is eequal to 1 in otherwords, find where the row has has session as active
        $classes = Klass::with(['student' =>
        function ($query) use ($currentSession) {
            $query->where('session_id', $currentSession);
        }])->get(['id', 'class_name']);

        $promotedClass = [];
        foreach ($classes as $key => $class) {
            dd($classes);
        }
        return view('backend.promotion.klasspromotion.index', compact('classes'));
    }


    public function promote(Request $req)
    {
        // dd($req->all());
        $req->validate([

            'class_id' => 'required',

            // 'prev_class' => 'required',
            // 'next_class' => 'required'
        ]);

        $student = new Student();
        // from the top of my head
        $school = Admin::AdminSchool()->id;

        $currentSession = Session::where('active', 1)->first();

        //get the existing session 
        //obviously I'm having date issues here
        $student->whereNull('session_id')->where('school_id', $school)->orWhere('session_id', '!=', $currentSession->id)->update([
            'class_id' => $req->class_id,
            'current_session' =>  $currentSession->session,
            'session_id' => $currentSession->id
        ]);

        if (isset($student)) {
            return redirect()->route('promote.klass.index')->with('msg', 'No worries! This class has already been promoted!!!');
        }


        return redirect()->route('promote.klass.index')->with('msg', 'Klass promoted successfully');
    }
}
