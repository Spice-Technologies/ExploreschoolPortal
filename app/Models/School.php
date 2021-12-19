<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['school', 'owner', 'email', 'phone', 'contact_addr'];


    public function admin()
    {
        return $this->hasMany(Admins::class);
    }
}
