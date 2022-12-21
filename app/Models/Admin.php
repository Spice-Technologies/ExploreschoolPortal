<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'user_id',
        'phone',
        'adminPw4SuperAdmin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'admin_id');
    }


    //currently logged in admin
    public static  function loggedInAdmin()
    {
        // this could just be|
        // return   Auth::user()->admin->id -- refactor!!!
        return  self::where('id', Auth::user()->admin->id)->first();
    }

    //the school admin belongs to
    public static function AdminSchool()
    {
        return  self::loggedInAdmin()->school;
    }
    //all the students under this  admin belongs to
    public static function admin_students()
    {
        return  self::AdminSchool()->with('student', 'student.user')->first()->student;
    }


    //all students that has not been promoted
    /** trash !!! */
    // public function scopeNonAdminPromotedStudents($query)
    // {
    //     $currentSession = Session::where('active', 1)->first();
    //     // return  self::AdminSchool()->with('student', 'student.user')->where('current_session', '!=',$currentSession->id)->first();

    //     return $query->where('school_id', self::AdminSchool()->id)->where('current_session',$currentSession->id)->toSql();
    // }

    //fetch all students under this same admin update on 10-11-2022 : this is not true. it is not fetchin gthat 

    public function scopeStudents($query, $school_id)
    {
        return $query->where('school_id', $school_id);
    }

    //get current logged in  admin

    //fetch all students under this same admin (same thing below)
    public function adminStudents()
    {
        return Auth::user()->admin->school->with('student', 'student.user')->first();

        //what I did to avoid n + 1 queries. I used eager loading:
        //1. I used toSql() to detect that the following query is basically saying 'select * from schools',
        //2. using 'with', I eagerloaded the student, then also eager loaded the users that the student has relationship with e.g ('student.users'). Thats basically what is happening in the above

        // The error thrown here ...with('student', 'student.id')->get(); made me realise that the dot (.) notation after the model name inside the withs arguments is referring the relationship function in that student model.
        /* e.g ...with('student', 'student.id')->get(); means

        Model Student
                    >>
                        >>
                            >>
                            public function user() {
                                //...your relationship definition
                            }
        */

        //that's the explanation but best understood by experience...i.e practice
    }


    /*
        Writing the scope query logic for selecting the things admin is going to see based on the school id

        admin::where->school_id=1->get->all->students
        //or get the school the admin belongs // using laravel scooping to achieve this
        //select all the students from that school that the admin belings to
        //

        public function scopeSchoolId($query, $school_id){
            return $query->where('school_id', $school_id);
        }
    */
//teacher

    public static function current_session()
    {
        return Session::where('active', 1)->first();
    }
}
