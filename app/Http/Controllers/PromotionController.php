<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promote(Request  $request)
    {
        //manual promotion
        // $request->validate([
        //     'class_id_from' => 'required|string',
        //     'class_id_to' => 'required|string',
        // ]);

        // bulk promotion

        //first thing to do is move the grade class to another table then update the remaiing rows

        ///update all where class_id = 1 to 2; 2 to 3; 3 to 4;
        $collection->each(function ($item, $key) {
            if (/* some condition */) {
                return false;
            }
        });
        $matches = [1, 2,];
        foreach ($matches as $m => $key) {
          
            $result = Student::where('class_id', '=', $m)->update(['class_id' =>   $key]);
          
        }
        return "Done successfully ";
        // for ($i = 0; $i < count($matches); $i++) {
        //     // return  $matches[$i];
        //     $jov = $i = $i + 1;
        //     $result = Student::where('class_id', '=', $i)->update(['class_id' => $jov]);
        // }
    }
}
