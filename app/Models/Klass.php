<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klass extends Model
{
    use HasFactory;
    //the hasMany situation has it that the parent id is in the child table ONLY

    protected $fillable  = [
        'class_name',
        'sub_class',
        'teacher_id', //I think we should not have this here but less see first 
        'class_description'

        //use the same method you used for insereting stuff in student table via user model
        // find the jss class like JSS1 then attach the A, B, 1 
        
        
        //I also feel that teacher relationship with class should be like the one I did for creating student relationship with class 

        //TIP: for promotion just change the class_id to the relative class id in original class table
    ];

    public function students()
    {// class has many many students but students has or must belong to only One Class
        return $this->hasMany(Student::class, 'class_id');
    }

}
