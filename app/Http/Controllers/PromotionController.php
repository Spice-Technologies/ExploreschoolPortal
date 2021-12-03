<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function index()
    {
        return view('backend.class.promote');
    }



    public function promote(Request  $request)
    {

        $matches = collect([1, 2, 3, 4, 5, 6]);
        //to avoid this stuff for repeating more than once in year, you will have to check for the session date in the database, against the current year, then fire the increment() stuff
        Student::whereIn('class_id', $matches)->increment('class_id', 1);
        //$h->toSql(); using this to output raw sql queries
        //I am honestly surprise why using $key to compare 'class_id' in the where clause works perfectly than using the $item which is the actual item as I thought

        // DB::table('users')->increment('votes', 1, ['name' => 'John']);

        return "I pray this stuff works";
    }
}
