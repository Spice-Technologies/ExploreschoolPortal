<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Demotion;
use App\Models\Klass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemotionController extends Controller
{


    public function demoteIndex()
    {
        $studentsClass = Student::where('demote_status', '=', 0)->where('school_id', Admin::AdminSchool()->id)->where('session_id', Admin::current_session()->id)->get();
        return view('backend.demotion.demote', compact('studentsClass'));
    }



    public function repromoteIndex()
    {
        $studentsClass = Student::where('class_id', '!=', 7)->where('school_id', Admin::AdminSchool()->id)->where('session_id', Admin::current_session()->id)->where('demote_status', 1)->get();
        return view('backend.demotion.repromote', compact('studentsClass'));
    }

    public function action(Request $r)
    {

        $current_session = Admin::current_session();
        $demotion = new Demotion();
        if ($r->demote == 'demote')
            return $demotion->demote($r, $current_session);
        if ($r->repromote == 'repromote')
            return $demotion->repromote($r, $current_session);
    }
}
