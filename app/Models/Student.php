<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'user_id',
        'parent_id',
        'class_id',
        'session_id',
        'SubKlass_id',
        'gender',
        'dateofbirth',
        'current_address',
        'current_session',
        'graduate_status',
        'permanent_address',
        'state',
        'lga',
        'country',
        'reg_num',
        'school_id',
        'admin_id',
        'studentPwd4AdminView'
    ];

    protected $dates = ['dateofbirth'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    ///  ????
    public function subKlass()
    {
        return $this->belongsTo(SubKlass::class);
    }

    public function class()
    {
        return $this->belongsTo(Klass::class, 'class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // see if you can make a relationship between student and result model --refactor later

    // fetch all students under this currently logged in admin (with the school the admin is logged in to)

    //uisng dynamic scoping
    // used to get the school the student belong to

    public function scopeSchoolId($query, $school_id)
    {
        return $query->where('school_id', $school_id);
    }



    public static function studentId()
    {
        return Auth::user()->student->id;
    }


    /*
            working on the promote class feature

            public function scopePromote($query, $class_id){
                return $query->where('class_id', $class_id);
            }
     */
}
