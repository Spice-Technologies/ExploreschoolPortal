<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class StudentImport implements WithHeadingRow, OnEachRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    protected $generateRegNumFunc, $randomStringForPassword, $current_session, $admin, $school, $class;

    public function __construct($generateRegNumFunc, $randomStringForPassword, $current_session, $admin, $school, $class)
    {
        $this->generateRegNumFunc = $generateRegNumFunc;
        $this->randomStringForPassword = $randomStringForPassword;
        $this->current_session = $current_session;
        $this->admin = $admin;
        $this->school = $school;
        $this->class = $class;
    }

    // we will use handling persistence approach because we'll need to control the upload to db.
    // Specifically we want to upload to Students table and Users table differenttly..so that's it
    //   https://docs.laravel-excel.com/3.1/imports/model.html#handling-persistence-on-your-own

    public function onRow(Row $roww)
    {


        $rowIndex = $roww->getIndex();
        $row      = $roww->toArray();

        $student = new Student();



        $user = User::create([
            'name' =>  $row['name'],
            'password' => Hash::make($this->randomStringForPassword),
        ]);
        // 'email' =>
        $user->student()->firstOrCreate([ // using the firstOrCreate because we need to persit the data first--if we used updateOrCreate--i will try
            'SubKlass_id' => $row['subclass'],
            'school_id' =>  $this->school->id,
            'class_id' => $this->class,
            'admin_id' =>  $this->admin->id,
            'gender' => $row['gender'],
            'dateofbirth' => $row['dateofbirth'],
            'lga' => $row['lga'],
            'state' => $row['state'],
            'country' => $row['country'],
            'permanent_address'  => $row['permanent_address'],
            'current_address' => $row['current_address'],
            'studentPwd4AdminView' => $this->randomStringForPassword,
            'current_session' => $this->current_session->session,
            'session_id' =>  $this->current_session->id,
            'demote_status' => 0,
            'graduate_status' => 0,
        ]);

        $reg = call_user_func($this->generateRegNumFunc, $user->student->id); // called the named function that generates this reg
        $user->assignRole('Student');
        $user->student->reg_num = $reg;
        $user->student->save();
        $user->email = $reg;
        $user->save();
    }
}
