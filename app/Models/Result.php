<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

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

    public function subjectModel()
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
}
