<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Pin;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;

class AdminResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.result.masterPdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $terms = Term::all();
        $klasses = Klass::get(['id', 'class_name']);

        $sessions = Session::get(['session', 'id']);
        return view('backend.result.create', compact('terms', 'sessions', 'klasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'term' => 'required',
            'class_id' => 'required',
            'session' => 'required' //exists:results,session_id

        ]);

        $result = new Result();

        //fetch the school that the loggedin admin belongs to
        $schoolAdmin = Admin::AdminSchool();

        //refactor this aspect later
        $resultInfo = [Session::where('id', $request->session)->first()->session, Term::where('id', $request->term)->first()->Term, Klass::where('id', $request->class_id)->first()->class_name];

        // <end> refactor this aspect later </end>

        $fetchResults = $result->getAllResult($request->session, $request->class_id, $request->term, $schoolAdmin->id);

        if (!$fetchResults) {
            return back()->with('msg', 'Error! Please kindly confirm from your dashboard that you have result records available for the session, term and class you have choosen !');
        } else {
            $subjects = $result->subjects;
            // PDF package used is laravel-mPDF not the popular laravel-dompdf
            $pdf = PDF::loadview(
                'backend.result.masterPdf',
                ['results' => $fetchResults, 'subjects' => $subjects, 'school' => $schoolAdmin, 'resultInfo' => $resultInfo],
                [],
                ['format' => 'A4-L', 'orientation' => 'L']
            );
            return $pdf->download('laravel-pdfworking.pdf');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // initiating a modal
    //when the student has finished checking the result,
    // load the modal to show the result to the student when the page has refreshed
    //with download option

    /**
     * To print single result sheet sepcifically for admins
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleResult(Request $request)
    {
        //alternative is to create admin folder and let all admin controllers be here

        $request->validate([
            'term' => 'required',
            'class_id' => 'required',
            'session' => 'required' //exists:results,session_id

        ]);
        // select student with the dates etc
        $student = Student::studentId();
        $result = new Result();
        $fetchResults = $result->getAllResult($request->session, $request->class_id);
        
        $pin = Pin::where('pin', $request->pin)->first();
      

        if ($pin->use_stats >= 900) return back()->with('msg', 'You have exceeded the number of times meant to use this pin');

        //if the pin is 'so fresh' and has never been used before 
        if ($pin->use_stats == 0) {
            $examPin =  $pin->update([
                'use_stats' => $pin->use_stats + 1,
                'student_id' =>  $student,
                'class_id' => $request->class_id,
                'term_id' =>  $request->term
            ]);
            //check if the student result has not bbeen uploaded // i think I should check for this first..maybe rearrange my if else statements
            if ($fetchResults == false) { //why not say, If not false  ?
                $examPin =  $pin->update([
                    'use_stats' => 0,
                    'student_id' =>  NULL,
                    'class_id' => NULL,
                    'term_id' =>   NULL
                ]);
                return back()->with('msg', 'Looks like your result has not been uploaded yet !!!');
            } else {
                return redirect()->back()->with('results', $fetchResults);
            }

            // when the record is not fresh 
        } else {
            $termsNth = ['Zeroth', 'first', 'second', 'third'];

            if ($pin->term_id != $request->term) return back()->with('msg', 'This pin is already tied to ' .  $termsNth[$pin->term_id] . ' Term Only. Which means that you can use this pin to check for only ' . $termsNth[$pin->term_id] . ' term results.');

            $examPin =  $pin->update([
                'use_stats' => $pin->use_stats + 1,
                'student_id' =>  $student,
                'class_id' => $request->class_id,
                'term_id' =>  $pin->term_id
            ]);


            $subjects = $result->subjects;

            $pdf = PDF::loadview('backend.result.masterPdf', ['results' => $fetchResults, 'subjects' => $subjects]);
            return $pdf->download('laravel-pdfworking.pdf');
        }

    }
}
