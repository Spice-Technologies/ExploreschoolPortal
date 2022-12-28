<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
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

        $session =  Session::first('session', $r->session)->session;
        $class =  Klass::first('class_name', $r->class)->class_name;
        $studentReg = $r->student;
        $name = Student::where('reg_num', $r->student)->first()->user->name;
     

        
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
                        // you can calcuate total subjects from here  but we are not calculating from here 

                        $subjectTotals[$subject]['total'] =

                            ($subjectTotals[$subject]['total']  ?? 0) +
                            $details['total'];
                        //implemeted to check for total number of terms a particular subject was written per term //question is that how was I able to do it ?like how did i know how to include the no of times stuff was set . the number of times you hit igbo language for example is recursive ! thhats how I got the igbo language. so at the begining it is not set so it is set to 0
                        $subjectTotals[$subject]['noOfTerm'] =
                            ($subjectTotals[$subject]['noOfTerm']   ?? 0) + 1;

                        // now set average

                        $subjectTotals[$subject]['avg'] =
                            $subjectTotals[$subject]['total'] /  $subjectTotals[$subject]['noOfTerm'];

                        //teacher remarks

                        $getGradeRemark = function (string $grade) {
                            $remarks =
                                [
                                    'A' => ['you have done noble', 'Good job keep it up', 'You are the champion'],
                                    'B' => ['You scored B, Keep trying harder', 'B you are not far from greatness', 'B thats awesome'],
                                    'C' => ['C You for try pass like this shaa', 'C you are almost there', 'C means cheap but you are not. Are you the one that is cheep or the questions ?'],
                                    'P' => ['P odogwu, wetin manU play, you too dy watch movie', 'BBnaija star..rich boi..see as you score low', 'P you are not a failure, so dont be one']
                                ];
                            $keys = array_rand($remarks[$grade]);
                            return $remarks[$grade][$keys];
                        };

                        //set grade
                        $totalScore =  $subjectTotals[$subject]['avg'];
                        switch ($totalScore) {

                            case  $totalScore >= 70 and  $totalScore <= 100:
                                $subjectTotals[$subject]['grade'] = 'A';
                                $subjectTotals[$subject]['gradeRemark'] = $getGradeRemark('A');
                                break;
                            case  $totalScore >= 60 and  $totalScore <= 69:
                                $subjectTotals[$subject]['grade'] = 'B';
                                $subjectTotals[$subject]['gradeRemark'] = $getGradeRemark('B');
                                break;
                            case  $totalScore >= 59 and  $totalScore <= 50:
                                $subjectTotals[$subject]['grade'] = 'C';
                                $subjectTotals[$subject]['gradeRemark'] = $getGradeRemark('C');
                                break;
                            case  $totalScore >= 50 and  $totalScore <= 49:
                                $subjectTotals[$subject]['grade'] = 'C';
                                $subjectTotals[$subject]['gradeRemark'] = $getGradeRemark('C');
                                break;
                            default:
                                $subjectTotals[$subject]['grade'] = 'F';
                                $subjectTotals[$subject]['gradeRemark'] = $getGradeRemark('P');
                        }
                    }
                }
        }

        arsort($result);
        $result['__subjectTotals'] = $subjectTotals;
        // dd($result);
        if ($result) {

            return view('backend.result.yearly.pdfyearly', compact('result', 'subs', 'session', 'class', 'studentReg', 'name'));
        } else {
            return redirect()->route('result.yearly')->with('error', 'You have no result for this class yet');
        }
    }
}
