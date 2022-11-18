<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Principal;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        return view('backend.settings.index');
    }


    public function store(Request $req)
    {
        // dd($req->all());
        // dd(empty($req->only('number')));
        // dd([...$req->only('number')]['number']);
        dd(Teacher::where('number', [23481038451353, 'jgjgjhj'])->exists());

        $req->validate(

            [
                'name.*' => Rule::requiredIf(function () use ($req) {
                    if (Teacher::whereNotIn('number', [...$req->only('number')]['number'])->count() > 0 && !empty($req->only('number')))
                        return true;
                    else
                        return false;
                }),


            ]
        );
        $school_id = Admin::AdminSchool()->id;

        Principal::createOrUpdate([
            'name' => $req->pname,
            'gender' => $req->gender,
            'number' => $req->number,
            'school_id' => $school_id
        ]);

        return redirect()->route('index');
    }
}
