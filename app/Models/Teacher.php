<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'admin_id',
        'school_id',
    ];


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }


    public function klasses()       
    {                                              //table             // FK class_id  PK teacher_id
         return $this->belongsToMany(Klass::class, 'teacher_classes', 'class_id', 'teacher_id');
    }
}
