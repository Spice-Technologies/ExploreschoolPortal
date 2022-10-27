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

        $classes = Klass::get(['id']);

        //where class == 5 and where current_session != session 
        // where $classes must be looped, then for each loop, we check if that one is same with 
// gloop through all the classes fro the main class table that are related to the students table then use it to check for the classes in that admin school that have been promoted already
        $mainClass = [];
        $classes->each(function($query) {
            $mainClass[] = $query->student->where('current_session', NULL)->all();
        });

        dump($mainClass);
        // $student->whereIn('class_id', $classes);

        return view('backend.promotion.klasspromotion.index', compact('classes'));
    }


    public function promote(Request $req)
    {
        $req->validate([
            'prev_class' => 'required',
            'next_class' => 'required'
        ]);

        $student = new Student();
        // from the top of my head

        $currentSession = Session::where('active', 1)->first();

        //get the existing session 

        $student->where('current_session' != $currentSession->session)->update([
            'class_id' => $req->next_class,
            'current_session' =>  $currentSession->session,
        ]);

        Student::where('current_session', $currentSession)->update([]);

        //two main things to do: get current session
        // get the existing session student account
        //I'm looking at linking the two so a belongs to relationship btw student and session 



        //I want to make sure that you are promoting for that particular session alone and not another session.
        //I also want to make sure that if the class has been promoted already, there is no need to promote it...
        //it should be able detect the class that has been promoted

    }
}
