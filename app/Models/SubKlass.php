<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKlass extends Model
{
    use HasFactory;

    protected $fillable  = [
        'subKlass_name',
        'class_id',
        'teacher_id', //I think we should not have this here but less see first 
        'sub_class_description'
    ];

    public function class() {
        return $this->belongsTo(Klass::class);
    }

}
