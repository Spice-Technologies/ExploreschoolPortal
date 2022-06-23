<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $carrier = [];

    protected $fillable = ['student_id', 'class_id', 'assessment_total', 'exam_score', 'total_score', 'subject_id', 'session_id', 'term_id', 'school_id', 'subject'];

    public function admin()
    {
        return $this->hasMany(Admin::class);
    }
    public function pin()
    {

        return $this->hasOne(Pin::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function class()
    {
        return $this->hasOne(Klass::class);
    }

    public function session()
    {
        return $this->hasOne(Session::class);
    }


    public function school()
    {
        return $this->belongsTo(School::class);
    }


    public function term()
    {
        return $this->hasOne(Term::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }


    /**
     * Return results checked by the student via the student id
     */

    public static function DisplayResult($student, $class, $session)
    {
        $r = self::where('student_id', $student)->where('class_id', $class)->where('session_id', $session);
        if ($r->exists()) return  $r->get();
        else
            return false;
    }

    public function getAllResult($regNum, $session, $class)
    {
        $this->carrier = self::where('RegNum', $regNum)->where('class_id', $class)->where('session_id', $session)->with('subject')->get()->toArray();
        //get total number of subjects then divide by total score...to get this as a single function or a single value we can do array reduce but i just want to map the number of subjects first

        //also note that we had something like $this->carrier[] so as to push the array below as the second item..if you use array_push for the array instance above this one, we'll have an array of array sort of which is not our desired goal..chidi bear this in mind 
        $this->carrier['noOfSubjects'] =  count(array_map(function ($v) {
            return $v['subject']['subject'];
        }, $this->carrier));

        return  $this->carrier;
    }

    public function getTotalScore()
    {
        $arr = array_filter(collect($this->carrier)->pluck(['total_score'])->toArray());

        return array_reduce($arr, function ($b, $v) {
            return  $b + $v;
        });
    }

    public function getTotalNumberOfSubjects()
    {
        return $this->carrier['noOfSubjects'];
    }

    public function getAverage()
    {
        return $this->getTotalScore() / $this->getTotalNumberOfSubjects();
    }

    //     ErrorException
    // Trying to access array offset on value of type int

    //learn about interfaces, trait and absrtact classes 
}
