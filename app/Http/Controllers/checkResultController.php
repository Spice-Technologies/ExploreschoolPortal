<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pin;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class checkResultController extends Controller


{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $terms = Term::all();
        return view('dashboard.Student.checkResult.create', compact('terms'));
    }

    /**
     * Return results checked by the student via the student id
     */

    private function DisplayResult($student)
    {

        $r = Result::where('student_id', $student);
        if ($r->exists()) return  $r->get();
        else
            return false;
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
            'term' => 'required'

        ]);

        $pin = Pin::where('pin', $request->pin)->first();

        $session = new Session();

        $userModel = Auth::user(); // you get the student from the userModel side 
        $student = $userModel->student->id;
        $fetchResults = $this->DisplayResult($student);

        if ($pin->use_stats >= 5) return back()->with('msg', 'You have exceeded the number of times meant to use this pin');

        //if the pin is so fresh and has never been used before 
        if ($pin->use_stats == 0) {
            $examPin =  $pin->update([
                'use_stats' => $pin->use_stats + 1,
                'student_id' =>  $student,
                'class_id' => $request->class_id,
                'term_id' =>  $request->term
            ]);
            //check if the student result has been uploaded 
            if ($fetchResults == false) {

                $examPin =  $pin->update([
                    'use_stats' => 0,
                    'student_id' =>  NULL,
                    'class_id' => NULL,
                    'term_id' =>  NULL
                ]);
                return back()->with('msg', 'Looks like your result has not been uploaded yet !!!');
            } else {
                return view('dashboard.Student.checkResult.show', compact('fetchResults'));
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
            return view('dashboard.Student.checkResult.show', compact('fetchResults'));
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
}
