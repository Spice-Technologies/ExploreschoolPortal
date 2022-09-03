<?php

namespace App\Http\Controllers;

use PDF;
use Session;

use Illuminate\Http\Request;

class PrintResultController extends Controller
{
    public function print()
    {
        if (Session()->has('results'))
            $data = Session()->get('results');
        $pdf = PDF::loadView('backend.result.print', compact('data'));
    }

    public function printPDf()
    {
        return  view('backend.result.masterPdf');
    }
}
