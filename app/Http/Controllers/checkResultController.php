<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pin;
use App\Models\Session;
use App\Models\Student;
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
        // select from pin table where request->pin is equal to pin in table
        //if pin is equal to pin in table
        //

        $request->validate([
            'pin' => 'required|exists:pins,pin',

        ]);

        $pin = Pin::where('pin', $request->pin)->first();

        $session = new Session();

        // dd(date('Y', strtotime('last year')));
        $userModel = Auth::user();
        $student = $userModel->student->id;
        if ($pin->student_id !=  $student) {
            return back()->with('msg', 'Pin does not belong to you');
        }
        if ($pin->use_stats < 5) {
            $examPin =  Pin::where('pin', $request->pin)
                ->where('use_stats', '<', 5)
                ->where('session_id', $session->latest()->first('id')->id)
                ->where('term_id', ) //get first value which is super and always
                ->update([
                    'use_stats' => $pin->use_stats + 1,
                    'student_id' =>  $student,
                    'class_id' => $request->class_id,
                ]);
        } else {
            return back()->with('msg',  'Pin has been used more than the required number of times. PLease buy new one');
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
