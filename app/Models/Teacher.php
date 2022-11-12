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


    public function class_id()
    {
        return $this->belongsToMany(Klass::class, 'class_id');
    }
}
