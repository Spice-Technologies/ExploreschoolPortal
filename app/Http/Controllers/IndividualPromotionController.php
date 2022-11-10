<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndividualPromotionController extends Controller
{
    public function index()
    {
        return view('backend.promotion.individual.index');
    }

    public function promote()
    {

        /// any promoted student will have a side indcator that says "promoted"
        return redirect()->route('promote.individual.index')->with('msg', 'Student was successfuly promoted to next class');
    }
}
