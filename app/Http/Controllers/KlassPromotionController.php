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

        $classes = Klass::get(['id', 'class_name']);
        return view('backend.promotion.klasspromotion.index', compact('classes'));
    }


    public function promote(Request $req)
    {
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

        $student->where('current_session','!=', $currentSession->session)->where('school_id', $school)->update([
            'class_id' => $req->class_id,
            'current_session' =>  $currentSession->session,
        ]);

        if(!$student){
            return "no updated happend";
        }

        return redirect()->route('promote.klass.index')->with('msg', 'Klass promoted successfully');
    }
}
