<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promote(Request  $request)
    {

        $matches = collect([1, 2]);
        
            Student::whereIn('class_id', $matches)->increment('class_id', 1);
            //I am honestly surprise why using $key to compare 'class_id' in the where clause works perfectly than using the $item which is the actual item as I thought
    
        return "I pray this stuff works";
    }
}
