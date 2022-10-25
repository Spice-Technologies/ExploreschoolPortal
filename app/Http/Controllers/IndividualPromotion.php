<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndividualPromotion extends Controller
{
    public function index()
    {
        return view('backend.promotion.individualpromotion.index');
    }
}
