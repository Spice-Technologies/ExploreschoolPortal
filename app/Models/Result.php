<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prophecy\Promise\ReturnPromise;

class Result extends Model
{
    use HasFactory;

    protected $carrier = [];
    protected $boeing = [];

    protected $testArr = [];

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

    public function getAllResult($session, $class)
    {
        $this->carrier = self::where('class_id', $class)->where('session_id', $session)->with('subject')->get()->toArray();

        // $this->boeing = array_column($this->carrier, 'RegNum');
        // $boe = $this->boeing;
        //   $y =array_fill_keys($this->boeing, array_filter($this->carrier, function($v) use($boe) {
        //             echo "<pre>";
        //             print_r($boe[0] );
        //             echo "</pre>";
        //   }));

        $array = array(
            0 => array(
                'id' => '20120100',
                'link' => 'www.janedoe.com',
                'name' => 'Jane Doe'
            ),

            1 => array(
                'id' => '20120100',
                'link' => 'www.janedoe.com',
                'name' => 'John Doe'
            ),
            2 => array(
                'id' => '20120101',
                'link' => 'www.johndoe.com',
                'name' => 'John Doe'
            )
        );

        $arrColum = array_column($array, 'name');
        $arr= array_column($this->carrier, 'RegNum');
        // dd(in_array('Jane Doe',$arrColum));
        $i = 0;
        $new_array = [];
        foreach ($array as $key => $value) {
            if (in_array($value['name'], $arrColum)) {
                $key = $value['name'] . '-' . $i;
                $new_array[] = [$key => $value];

                $i++;
            }
        }
        dd(array_diff_key( $arr , array_unique( $arr ) ));
    }
    // having the subjects, totalscore, etc in this format ["English","ogombo-campus"] i.e like json is the better approach         
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
