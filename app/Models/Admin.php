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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    } 

    public static function AdminSchool(){
        return  self::where('id', Auth::user()->admin->id)->first()->school;
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
}
