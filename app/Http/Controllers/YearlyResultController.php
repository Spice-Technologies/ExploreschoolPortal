<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Result;
use App\Models\Session;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\Request;

class YearlyResultController extends Controller
{
    public  function index()
    {
        $terms = Term::all();
        $klasses = Klass::get(['id', 'class_name']);

        $sessions = Session::get(['session', 'id']);
        $admin = new Admin();
        $students =  $admin->adminStudents()->student;

        //get the current logged in admin that use that to get all other details you may be needing

        return view('backend.result.yearly.yearly', compact('terms', 'sessions', 'klasses', 'students'));
    }

    public function print(Request $r)
    {
        $r->validate([
            'session' => 'required',
            'class' => 'required',
            'student' => 'required',
        ]);
        $result = new Result();

        $result = $result->yearlyResult($r->session, $r->class, 'Mob/22/0002');
        // dd($r->student);

        $subjects = Subject::get('subject')->toArray();
        $subjects = array_column($subjects, 'subject');
        // sort($result);
        // dd($result);
        if ($result) {

            return view('backend.result.yearly.pdfyearly', compact('result', 'subjects'));
        } else {
            return redirect()->route('result.yearly')->with('error', 'You have no result for this class yet');
        }
    }
}
