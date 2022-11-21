<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvStudentController extends Controller
{

    public function index()
    {
        return view('backend.students.bulkaddstudent');
    }
    public function store()
    {
        return "Please save me ! ";
    }
}
