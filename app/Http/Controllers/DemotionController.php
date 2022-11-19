<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemotionController extends Controller
{
    public function demote(Request $r)
    {
        $current_session = Admin::getcurrent_session();
        $cantDemoteArr = [];
        // consider if the student(s) has been demoted before for this current session
        // then throw error message
        // you can't demote someone you did not promote---asin coming into a new session
        // you can only demote someone you promoted as long as that academic year is concerned...Once the academic year or session is over, forget about it !

        if (empty($r->chekId)) // you can use laravel default validation rule to adjust this stuff later
            return redirect()->route('student.index')->with('msg', '❌ No student was selected !');

        foreach ($r->chekId as $key => $value) {
            $demotor = DB::table('students')->where('id', $value)->where('session_id', $current_session->id)->where('demote_status', 0)->decrement('class_id', 1, ['demote_status' => 1]);
            // if there are some selected users that have already been promoted, pass them to the cantDemote array
            if (!$demotor) {
                $cantDemoteArr[] = Student::where('id', $value)->with('user')->first()->user->name;
            }
        }

        // if some students have been promoted 
        if (!empty($cantDemoteArr))
            return redirect()->route('student.index')->with('msg', ' 👋 Student(s) demoted successfully except for  ' . implode(', ', $cantDemoteArr) . ' 👨‍🎓 who have already been promoted in this session, ' . $current_session->session);
        else
            return redirect()->route('student.index')->with('msg', 'Students has been demoted  🎉 🎊');
    }
}
