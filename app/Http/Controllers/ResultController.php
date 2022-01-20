<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\ResultsImport;
use App\Models\Klass;
use App\Models\Result;
use App\Models\Session;
use App\Models\SubKlass;
use App\Models\Term;
use Barryvdh\DomPDF\PDF;
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

    public function master()
    {
   
        $sessions = Session::all();
        $classes = Klass::all();
       // $subClass = SubKlass::all();
        $terms = Term::all();
    
        return view('backend.result.mastersheet', compact('sessions', 'classes', 'terms'));

    }

     public function masterPdfGen(  $session_id, $klass_id, $term_id) {

        $session = Session::find($session_id);
        $klass = Klass::find($klass_id);
        $term = Term::find($term_id);
        $subClass = SubKlass::where('klass_id', $klass_id)->get();
        $results = Result::where('session_id', $session_id)
                            ->where('klass_id', $klass_id)
                            ->where('term_id', $term_id)
                            ->get();
        $pdf = PDF::loadView('backend.result.masterpdf', compact('session', 'klass', 'term', 'subClass', 'results'));
        return $pdf->download('result.pdf');
        
     }


    
}
