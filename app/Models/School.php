<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['school', 'owner', 'email', 'phone', 'contact_addr', 'lga', 'state', 'website'];

    protected $guarded = ['active'];

    public function admin()
    {
        return $this->hasMany(Admin::class);
    }
    public function pin()
    {

        return $this->hasOne(Pin::class);
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
