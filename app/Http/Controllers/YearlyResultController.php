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

        foreach ($result as $term => $value) {
            if (!str_starts_with($term, '__'))
            foreach ($value as $subj => $v) {

                foreach ($subs as $l => $c) {
                    if ($subj == $c)
                    // dd( $result[$term][$subj]['total']);
                        $result[$term]['total_marks'][$subj] =  $result[$term][$subj]['total'] + 
                        $result[$term][$c]['total'];
                    // $result[$reg][$term][$subject]['total_marks'] = $result[$reg][$term][$subject]['total'];
                }
            }
        }
        dd($result);
        arsort($result);
        // dd($result);
        if ($result) {

            return view('backend.result.yearly.pdfyearly', compact('result', 'subs'));
        } else {
            return redirect()->route('result.yearly')->with('error', 'You have no result for this class yet');
        }
    }
}
