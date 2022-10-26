<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;

class KlassPromotionController extends Controller
{
    public function index()
    {

        $classes = Klass::all();
        return view('backend.promotion.klasspromotion.index', compact('classes'));
    }


    public function promote(Request $req)
    {
        $req->validate([
            'prev_class' => 'required',
            'next_class' => 'required'
        ]);
        $session = new Session();
        $student = new Student();
        // from the top of my head

        $currentSession = Session::where('active', 1)->first();

        //get the existing session 

        if($currentSession != $session) {
            $student->where('current_session' != $currentSession)->update([
                'class_id' => $req->next_class
            ]);
        }
        Student::where('current_session', $currentSession)->update([

        ])

        //two main things to do: get current session
        // get the existing session student account
        //I'm looking at linking the two so a belongs to relationship btw student and session 



        //I want to make sure that you are promoting for that particular session alone and not another session.
        //I also want to make sure that if the class has been promoted already, there is no need to promote it...
        //it should be able detect the class that has been promoted

    }
}
