<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;

    protected  $fillable = [
        'pin', 'session_id', 'school_id',
    ];

    protected  $guarded = [ //you can even avoid writiing the guarded as anything value outside the filllable is treated as guarded
        'generated',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function session()
    {

        return $this->belongsTo(Session::class);
    }

    //To generate a pin base on request

    // the pin is stored in the database with the school id 

    // the pin is also stored in the database with the session ID 

    //reqeust pin form fields
    // the school you want to generate pin for (drop down)
    // obviously, the session for that pin (drop down old sessions will not appear except for current session)
    // the number of pins to generate( number field )
}
