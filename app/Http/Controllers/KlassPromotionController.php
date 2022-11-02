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
       // Laravel Eloquent Filter By Column of Relationship
       // This is just perfect for what I need. Get the number of classes to show depending on the related model or filter base on the related Model conditions
       //simply saying "whereHas this condition, 
       //its simply a situation where the number of results from the start model reference 
        $classes = Klass::whereHas(
            'student',
            function ($query) use ($currentSession) {
                $query->where('session_id', $currentSession);
            }
        )->get(['id', 'class_name'])->toArray();

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
