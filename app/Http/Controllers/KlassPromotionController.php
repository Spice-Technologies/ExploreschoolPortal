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
        $loggedInAdmin =  Admin::loggedInAdmin();
        $classes = Klass::where('admin_id', $loggedInAdmin)->with('student')->get(['id', 'class_name']);
        //where class is same to the id uding relationship, then make sure its same admin and where the row has the current session
        $promotedClass = [];
        foreach ($classes as $key => $class) {
            dd($classes[1]->student[0]->admin);
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
