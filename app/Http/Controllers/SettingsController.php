<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Principal;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        // $info = Teacher::get(['name', 'number']);
        //how do you properly pull the students and the ones related with their teachers
        return view('backend.settings.index');
    }


    public function store(Request $req)
    {
        // dd($req->all());
        // dd(empty($req->only('number')));
        // dd([...$req->only('number')]['number']);
        $req->validate(

            [
                'name.*' => 'required',
                'number.*' => 'required'


            ]
        );
        $school_id = Admin::AdminSchool()->id;

        // please check if the teacher has setttings before
        $teacher = new Teacher();
        // dd($req->except('_token'));
        foreach ($req->name as $key => $value) {

            $teacher->name = $value;
            $teacher->number = $req->tel[$key];
            $teacher->admin_id =  $school_id;
            $teacher->klasses()->attach([1]);
            $teacher->save();
        }
        // so once you are registering a school, the settings table is updated too with the school id, etc
        //later we can update the admin id with the details of the first admin to set the settings shaa
        //or who soever is the admin to set the settings 
        return redirect()->route('settings')->with('msg', 'Saved');
    }
}
