<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Student extends Model
{
    use HasFactory;

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
        'permanent_address',
        'state',
        'lga',
        'country',
        'reg_num',
        'school_id',
        'studentPwd4AdminView'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
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
