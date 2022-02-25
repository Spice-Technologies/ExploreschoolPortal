<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pin;
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

    private function DisplayResult($student) {

       return  Student::find($student);

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
        //  use this place to make sure that the student has 

        $pin = Pin::where('pin', $request->pin)->first();

        $session = new Session();

        // dd(date('Y', strtotime('last year')));
        $userModel = Auth::user();
        $student = $userModel->student->id;
        if ($pin->use_stats >= 5) return back()->with('msg', 'You have exceeded the number of times meant to use this pin');

        if ($pin->term_id == NULL &&  $pin->session_id == $session->latest()->first('id')->id) {
            $examPin =  $pin->update([
                'use_stats' => $pin->use_stats + 1,
                'student_id' =>  $student,
                'class_id' => $request->class_id,
                'term_id' =>  $request->term
            ]);

            $resultDisplay = $examPin ? true : false;
            // dd($resultDisplay);


            $fetchResult = $this->DisplayResult($student);

            return view('dashboard.Student.checkResult.show', compact('text', 'fetchResult'));
    
        //  return redirect('folder.name', compact('variableName');

            return back()->with(['pdfSuccess' => 'You have exceeded the number of times meant to use this pin', 'pdfDown' =>  $resultDisplay]);

            // return redirect()->route('school.index');
            // return view('result.create', compact('resultDisplay'));
        } else {
            $termsNth = ['Zeroth', 'first', 'second', 'third'];

            if ($pin->term_id != $request->term) return back()->with('msg', 'This pin is already tied to ' .  $termsNth[$pin->term_id] . ' Term Only. Which means that you can use this pin to check for only ' . $termsNth[$pin->term_id] . ' term results.');

            $examPin =  $pin->update([
                'use_stats' => $pin->use_stats + 1,
                'student_id' =>  $student,
                'class_id' => $request->class_id,
                'term_id' =>  $pin->term_id
                //once a student has used a particurlar pin, that pin is automtically tied to him/her
            ]);
            return back()->with('msg',  'Success');
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
