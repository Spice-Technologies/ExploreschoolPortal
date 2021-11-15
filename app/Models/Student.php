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
        'gender',
        'phone',
        'dateofbirth',
        'current_address',
        'permanent_address',
        'reg_num'
    ];

    protected $dates = [
        'dateofbirth' 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
