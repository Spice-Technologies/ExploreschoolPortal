<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use Illuminate\Http\Request;

class KlassPromotionController extends Controller
{
    public function index()
    {

        $classes = Klass::all();
        return view('backend.promotion.klasspromotion.index', compact('classes'));
    }
}
