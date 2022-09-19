<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;

class adminSingleResult extends Controller
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
        $students =  $admin->adminStudents();
        //get the current logged in admin that use that to get all other details you may be needing

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

        $fetchStudent = Result::where('class_id', $r->class)->where('term_id', $r->term)->where('session_id', $r->session)->where('student_id', $r->student)->first();

        $wholeClasses = $rus->get_details_of_whole_class($r->class, $r->term, $r->session);
        //filter that particular student

       $wholeCl= array_filter($wholeClasses, function ($value) use ($fetchStudent) {
            foreach ($value as $v) {
              
                return $v['student_id'] == $fetchStudent->student_id;
            }
        });

        dump($wholeCl);

        return view('backend.result.pdfsing', compact('fetchStudent', 'wholeClasses'));
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
