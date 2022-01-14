<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\ResultsImport;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{

    public function index()
    {
        return view('backend.result.upload');
    }

    public  function importResult(Request $request)
    {

        $file = $request->file('file');
        Excel::import(new ResultsImport,  $file);
        return back()->with('msg', 'Import Upload was successfull');
    }
}
