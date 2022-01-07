<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model 
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'class_id',
        'SubKlass_id',
        'gender',
        'dateofbirth',
        'current_address',
        'permanent_address',
        'state',
        'lga',
        'country',
        'reg_num',
        'school_id'
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


    //uisng dynamic scoping

     public function scopeSchoolId($query, $school_id){
         return $query->where('school_id', $school_id);
     }
}
