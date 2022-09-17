<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;
use Prophecy\Promise\ReturnPromise;

class Result extends Model
{
    use HasFactory;

    protected $carrier = [];
    protected $arrComputed = [];
    public $subjects = [];

    protected $fillable = ['student_id', 'class_id', 'assessment_total', 'exam_score', 'total_score', 'subject_id', 'session_id', 'term_id', 'school_id', 'subject', 'RegNum'];

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


    public function getAllResult($session, $class, $term, $school)
    {
        //make sure that the admin is on the right school that belongs to him 

        //get the admin, get the school, get the students in that selected class(): i.e from the result table

        //so school Id variable will now be the school the admin belongs to..

        //get the subject taken by that class via the school
        $noOfSubjectsTaken = Subject::get('subject')->count();


        $this->carrier = self::where('class_id', $class)->where('session_id', $session)->where('term_id', $term)->where('school_id', $school)->with('subject')->get()->toArray();

        // Setting the subjects header for the table 
        $this->subjects = ['Dont start counting @ zero'];
        foreach ((Subject::get('subject')->toArray()) as $v) {
            foreach ($v as $val) {
                $this->subjects[] = $val;
            }
        }
        /*
             so here is where the code is selecting all the items in array with same index !
             this is where the unique identifier is happening !

             //always bear in mind that the code ran 3 times (no of iteractions) then for each iterations, it picked the menu names (aka index in our code above) for the respective arrays in $array base on its's keys [0,1,2] ! Hence aslong ad the keys are different...

             fun fact: naturally php don't like to reiterate over arrays with same keys two times !!! so thst is why the grouping is possible. php noticed that clients key appears twice, it just peruse over it or slides it or ignores it and still use the clients index for second iteration, then noticed that the sub_menu names are different so it adds that too to sub menu
             .

             It will work
             So in summary.

             1.Have differnt chief parent ids
             2. Pick a unique identifier
             3. Group it with by the virtue of a different sub menu name 

    */
        //let me write my onw 

        /***  *****************************   The Wrapper of this code. The main boss... Use array reduce to kind of group arrays and reduce them to their respectives values *************************************************************/
        // dd($func([1,2,3]));
        $i = 0; //passed by reference(&$i) ---- Wisdom dy this my brain---I sabi this thing !!!

        $this->arrComputed  = array_reduce($this->carrier, function ($accumulator, $item) use (&$i,  $noOfSubjectsTaken) {
            $index = $item['RegNum'];

            //if it is set is for the regnum..you are checking if the regnum is already existing 
            //if it is not set will make it do the iteration again inside 

            if (!isset($accumulator[$index])) {
                $i++;
                $accumulator[$index] = [
                    'id' => $item['id'],
                    'RegNum' => $item['RegNum'],
                    'submenu' => [],
                    'Tscore' => 0,
                    'Tsubjects' => 0,
                    'Average' => 0
                ];
            }

            $subMenu = $accumulator[$index]['submenu'][] = [
                'idIdentifier' => $item['id'],
                'subject' => $item['subject']['subject'],
                'subject_id' => $item['subject']['id'],
                'total_score' . $item['id'] => $item['total_score'], // I will be using the ids as their identifiers so that in calculating the total scores there are no duplications or situation of calculating duplicate ids ..hence this result of unique ids also depends on how I chose to store the result into the database... hence alwasy bear in mind of your databse structure as it is key to your result.
            ];

            // getting the total score of all subjects
            foreach ($accumulator[$index]['submenu'] as $key => $v) {
                $accumulator[$index]['Tscore'] =  $accumulator[$index]['Tscore'] + ($v['total_score' . $item['id']] ?? 0);
                //  this in particular is what is checking if the total_score is not set yet, just add 0 instead of throwing an errorr..omorrr !!! Senior Devvvv !!! 
            }
            //get the total number of subjects
            $accumulator[$index]['Tsubjects'] = $noOfSubjectsTaken;
            // formerly I did count($accumulator[$index]['submenu']);
            //get the average of each students
            $accumulator[$index]['Average'] = round($accumulator[$index]['Tscore'] / $accumulator[$index]['Tsubjects'], 2);

            return $accumulator;
        }, []);


        // dd($this->arrComputed);

        // getting the position for the students. Everything here is sorted base on the average. From highest to lowest.  
        $sort = usort($this->arrComputed, function ($a, $b) {
            return $a['Average'] < $b['Average'];
        });
        // array_filter()

        // dd($this->arrComputed);
        return $this->arrComputed;
        /*
        Code comment:
        1. Start the accumulator with an empty array instead of the default null
        2. get the index or identifier for the grouping you want
        3. then create a new array with that identifier as your starting key while assigning new assoc array and items to it:  new keys and the values  
        4. then add an array to  the  submenu array inside index array 
        no 4 is the unique identifier so all indexes with clients index for example will be grouped togther
        */
    }

    //for class average, write an accessor that will always check for any class average and implement that 

    public function singleAverage($stuff)
    {
        return $score =  count($stuff);
    }

    public function position($wholeClass, $mainStudent)
    {

        //iterate or do something with all the whole class memebers
        //check for each student on that subject , take another iteration that loops through, while calculating the average and compare that avergae with the current average of that student with and indicator, at what point the avearge is greate

        //get average for main student per subject
        //likely array to use
        //array_map;to perform and operation using a fucntion on each item of the array
        // then array_filter

        $avergaeScore = 0;
        $arr = [];
        $indicator = 0;
        $totalSubject = count($wholeClass->get());
        // foreach ($wholeClass->get() as $key => $v) {
        //     $otherAvg = $v->total_score /  $totalSubject;
        //     $arr[$v->subject .$v->RegNum];
        //     if ($otherAvg >= $arr[$v->subject . $v->RegNum]) {
        //         $avergaeScore = $indicator;
        //     } else {
        //         $indicator++;
        //     }
        // }



        foreach ($mainStudent as $st) {
            $arr[$st->subject . $st->RegNum]  =  $st->total_score / $totalSubject;
        }
        dd($arr);
        /// where the student id = 
        //get the average for that subject
        //use that avearge gotten to check the student 
        //also count the avearge score in that class for all students
        //then compare
        // with an indicator, at any point the avearge is greater than any student / the rest of the student, get the value of that indicator for that is our position



    }
}
