<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;
use PDF;

class adminSingleResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.result.pdfSingleResult');
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
        $admin = new Admin();
        $students =  $admin->adminStudents()->student;
        //get the current logged in admin that use that to get all other details you may be needing
        // dump($students);



        return view('backend.result.singleAdminResult', compact('terms', 'sessions', 'klasses', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function showResult(Request $r)
    {

        // dd($r->all());
        $rus = new Result();

        $r->validate([
            'term' => 'required',
            'class' => 'required',
            'session' => 'required', //exists:results,session_id
            'student' => 'required',
        ]);
        //try eager laoding with() 
        //the query is suppose to have the admin  and the school it is trying to get
        //when the admin wants to upload to the db, the admin need to check for it too
        //improve this code (N + 1) queries

        // handle alot of data

        $fetchStudent = Result::where('class_id', $r->class)->where('term_id', $r->term)->where('session_id', $r->session)->where('student_id', $r->student)->first();
      

        //lets get the report card name details using the student model
        if (is_null($fetchStudent)) {
            return redirect()->route('result.singleResult')->with('msg', 'Students promoted successfully');
        }


        $student_info = Student::with('class.teacher', 'user')->find($fetchStudent->student_id);


        $finaleSingleCourseResult = $rus->get_single_result($r->class, $r->term, $r->session, $fetchStudent->student_id);
        return view('backend.result.pdfsing', compact('fetchStudent', 'finaleSingleCourseResult', 'student_info'));
        // $pdf = PDF::loadView('backend.result.pdfsing', compact('fetchStudent', 'finaleSingleCourseResult', 'student_info'));

        // return $pdf->download('Single result.pdf');

    }

    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
