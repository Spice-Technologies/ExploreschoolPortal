<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemotionController extends Controller
{
    public function demote(Request $r)
    {
        
        foreach ($r->chekId as $key => $value) {
            DB::table('students')->where('id', $value)->decrement('class_id');
        }
        return redirect()->route('student.index')->with('msg', 'User has been demoted successfully');
    }
}
