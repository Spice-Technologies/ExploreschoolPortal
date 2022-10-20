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



class checkResultController extends Controller
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
        return view('dashboard.Student.checkResult.create', compact('terms', 'sessions', 'klasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // select from pin table where request->pin is equal to pin in table
        //if pin is equal to pin in table
        //

        $request->validate([
            'pin' => 'required|exists:pins,pin',
            'term' => 'required',
            'class_id' => 'required',
            'session' => 'required' //exists:results,session_id

        ]);
        $student = Student::studentId();
        $result = new Result();

        $fetchResults = $result->get_single_result($request->class_id,  $request->term, $request->session, Auth::user()->student->id);

        $pin = Pin::where('pin', $request->pin)->first();

        if ($pin->use_stats >= 5) return back()->with('msg', 'You have exceeded the number of times meant to use this pin');

        //check if result has been uploaded
        if ($fetchResults != false) {
            //if the pin is 'so fresh' and has never been used before 
            if ($pin->use_stats == 0) {
                $examPin =  $pin->update([
                    'use_stats' => $pin->use_stats + 1,
                    'student_id' =>  $student,
                    'class_id' => $request->class_id,
                    'term_id' =>  $request->term
                ]);
            } elseif ($pin->use_stats <= 5) {

                if ($pin->term_id != $request->term || $pin->class_id != $request->class_id  || $pin->session_id != $request->session) {
                    $termsNth = ['Zeroth', 'first', 'second', 'third'];
                    return back()->with('msg', 'This pin is already tied to ' .  $termsNth[$pin->term_id] . ' term, for the session, ' . Session::where('id', $pin->session_id)->first('session')->session . ' and for the class ' . Klass::where('id', $pin->class_id)->first('class_name')->class_name . '.Note that your pin can only be used once for the class, term and session choosen intially with a fresh card');
                    // that thing I did above is not the best but lets us manage it for now. That's why softwares have versions--this is version 0.1
                } else {

                    $examPin =  $pin->update([
                        'use_stats' => $pin->use_stats + 1,
                        'student_id' =>  $student,
                        'class_id' => $request->class_id,
                        'term_id' =>  $request->term
                    ]);
                }
            }

            dd($fetchResults);

            // $pdf = PDF::loadView('backend.result.pdfsing', compact('fetchStudent', 'finaleSingleCourseResult'));

            // return $pdf->download('Single result.pdf');

        } else {

            return back()->with('msg', 'Looks like your result has not been uploaded yet !!!');
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
}
