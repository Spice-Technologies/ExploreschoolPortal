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
        //liat al subjects
        $subs = [];
        foreach ($result as $subkey => $value) {
            if (!str_starts_with($subkey, '__'))
                foreach ($value as $k => $v) {
                    if (!str_starts_with($k, '__') && !in_array($k, $subs))
                        $subs[] = $k;
                }
        }
        $subjectTotals = [];
        foreach ($result as $valK => $mark) {
            if (!str_starts_with($valK, '__'))
                foreach ($mark as $subject => $details) {

                    if (!str_starts_with($subject, '__')) {
                        $subjectTotals[$subject]['total'] =

                            ($subjectTotals[$subject]['total']  ?? 0) +
                            $details['total'];
                        //implemeted to check for total number of terms a particular subject was written per term //question is that how was I able to do it ?like how did i know how to include the no of times stuff was set 
                        $subjectTotals[$subject]['noOfTerm'] =
                            ($subjectTotals[$subject]['noOfTerm']   ?? 0) + 1;

                        // now set average

                        $subjectTotals[$subject]['avg'] =
                            $subjectTotals[$subject]['total'] /  $subjectTotals[$subject]['noOfTerm'];
                    }
                }
        }


        arsort($result);
        $result['__subjectTotals'] = $subjectTotals;
        // dd($result);
        if ($result) {

            return view('backend.result.yearly.pdfyearly', compact('result', 'subs'));
        } else {
            return redirect()->route('result.yearly')->with('error', 'You have no result for this class yet');
        }
    }
}
