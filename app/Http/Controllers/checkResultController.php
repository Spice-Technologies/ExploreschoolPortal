<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pin;
use App\Models\Student;
use Illuminate\Http\Request;

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
            return view('dashboard.Student.checkResult.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function update(Request $request, Pin $pin)
    {
                // select from pin table where request->pin is equal to pin in table
        //if pin is equal to pin in table
        //
        
       $examPin =  Pin::where('pin', $request->pin)
       ->where('use_sats' <= 5)
       ->where('school_id', $request->school_id)
       ->where('class_id', $request->class_id)
       ->where('session_id', $request->session_id);

       if ($examPin){
        $pin->update([
            'use_sats' => $pin->use_sats + 1,
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            
        ]);

       }

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
