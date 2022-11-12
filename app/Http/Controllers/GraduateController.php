<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    public function index()
    {
        $current_session = Session::where('active', 1)->first();
        $graduates = Student::where('class_id', 7)->where('session_id', $current_session->id)->get();
        $sessions = Session::all();
        return view('backend.students.graduates.index', compact('sessions', 'graduates'));
    }
}
