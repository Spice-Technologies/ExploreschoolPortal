<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Demotion extends Model
{
    use HasFactory;


    public function demote($r, $current_session)
    {
    
        if (empty($r->chekId)) // you can use laravel default validation rule to adjust this stuff later
            return redirect()->route('action.demote')->with('msg', '❌ No student was selected !');

        foreach ($r->chekId as $key => $value) {
            $demotor = DB::table('students')->where('id', $value)->where('session_id', $current_session->id)->where('demote_status', 0)->decrement('class_id', 1, ['demote_status' => 1]);
        }

        return redirect()->route('action.demote')->with('msg', ' 👋 Student(s) demoted successfully 🎉 🎊');
    }



    public function repromote($r, $current_session)
    {
        if (empty($r->chekId)) // you can use laravel default validation rule to adjust this stuff later
            return redirect()->route('action.repromote')->with('msg', '❌ No student was selected !');

        foreach ($r->chekId as $key => $value) {
            $demotor = DB::table('students')->where('id', $value)->where('session_id', $current_session->id)->where('demote_status', 1)->increment('class_id', 1, ['demote_status' => 0]);
        }

        return redirect()->route('action.repromote')->with('msg', ' 👋 Student(s) Repromoted!🎉 🎊');
    }
}
