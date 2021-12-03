<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promote(Request  $request)
    {

        $matches = collect([1, 2]);
        $matches->each(function ($item, $key) {

            Student::where('class_id', '=', $key)->update(['class_id' => $item  + 1]);
            //I am honestly surprise why using $key to compare 'class_id' in the where clause works perfectly than using the $item which is the actual item as I thought
        });
        return "I pray this stuff works";
    }
}
