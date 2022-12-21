<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Result;
use App\Models\Session;
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

        $result = $result->yearlyResult($r->session, $r->class);
        // dd($r->student);

        if ($result) {
            $result = $result["Mob/22/0002"];

            dd($result);

            // foreach ($result as $o => $value) {
            //     if (!str_starts_with($o, '__')) {
            //         dump($result[$o]);
            //     }  
            // }
                   return view('backend.result.yearly.pdfyearly', compact('result'));
            // $pdf = PDF::loadView('backend.result.pdfsing', compact('fetchStudent', 'finaleSingleCourseResult'));

            // return $pdf->download('Single result.pdf');
        } else {
            return redirect()->route('result.yearly')->with('error', 'You have no result for this class yet');
        }
    }
}
