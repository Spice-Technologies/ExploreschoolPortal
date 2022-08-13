<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klass extends Model
{
    // questions to ask chisom: can you assign class teacher to each class ?
    //when do you make a table, you need a table in situations when youhave to keep adding more default attributes...or somethngn lik ethat
    //one class has many students;  one class has many subclasses; one subclass has many students ;
    use HasFactory;
    //the hasMany situation has it that the parent id is in the child table ONLY

    protected $fillable  = [
        'class_name',
        'teacher_id', //I think we should not have this here but less see first 
        'class_description'

        //use the same method you used for insereting stuff in student table via user model
        // find the jss class like JSS1 then attach the A, B, 1 


        //I also feel that teacher relationship with class should be like the one I did for creating student relationship with class 

        //TIP: for promotion just change the class_id to the relative class id in original class table
    ];

    public function students()
    { // class has many many stu$studentClass->reg_numdents but students has or must belong to only One Class
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subClasses()
    {
        return $this->hasMany(SubKlass::class, 'class_id');
    }

    public function result(){
        return $this->hasMany(Result::class, 'class_id');
    }
}
