<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;
use Prophecy\Promise\ReturnPromise;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
    // result should not be related by one session
    //sessions can have many results--refactor!
    public function session()
    {
        return $this->belongsTo(Session::class);
    }


    public function school()
    {
        return $this->belongsTo(School::class);
    }


    public function term()
    {
        return $this->belongsTo(Term::class);
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


    /*  This is the main SINGLE RESULT CALCULATOR */
    public function get_single_result($class, $term, $session, $student)
    {
        // how am I making sure that this result is printed by the specific admin attached with this school ?
        //get all students --> basically orderBy subject name
        $groupedSubPerSt =  $this->with('session', 'term')->where('class_id', $class)->where('term_id', $term)->where('session_id', $session)->orderBy('total_score', 'DESC')->get()->groupBy('subject')->toArray();
        // -----    


        foreach ($groupedSubPerSt as $key => $V) {
            //get total std per subject 
            $totalStudentPerSubj = count($V);
            // append the the total number of students with it custom array key and new value
            $groupedSubPerSt[$key]['total_student'] =  $totalStudentPerSubj;
            //get avearge and append it to the sub array for student
            foreach ($V as $vkey => $v) {
                //get average
                $avg = $v['total_score'] / $totalStudentPerSubj;
                //append the average with it's own unique key
                $groupedSubPerSt[$key][$vkey]['avg'] =  $avg;

                // position
                // how did I calcualte this position ???---- asked on 18-10-2022 --- ???
                // it is from the 'order_by() method. I ordered the array by total_score..cos in reality, the higher the total score, the higher the average. So by default, the avergae is detected already but I just have to use the key ($vkey + 1) then append the position
                $groupedSubPerSt[$key][$vkey]['position'] =  $vkey + 1;

                //named function that i can use within this function so as to avoid the use of $this->getGradeRemark 👇👇👇

                $getGradeRemark = function (string $grade) {
                    $remarks =
                        [
                            'A' => ['you have done noble', 'Good job keep it up', 'You are the champion'],
                            'B' => ['You scored B, Keep trying harder', 'B you are not far from greatness', 'B thats awesome'],
                            'C' => ['C You for try pass like this shaa', 'C you are almost there', 'C means cheap but you are not. Are you the one that is cheep or the questions ?'],
                            'P' => ['P odogwu, wetin manU play, you too dy watch movie', 'BBnaija star..rich boi..see as you score low', 'P you are not a failure, so dont be one']
                        ];
                    $keys = array_rand($remarks[$grade]);
                    return $remarks[$grade][$keys];
                };

                // determine the grade 
                $totalScore = $v['total_score'];
                switch ($totalScore) {

                    case  $totalScore >= 70 and  $totalScore <= 100:
                        $groupedSubPerSt[$key][$vkey]['grade'] = 'A';
                        $groupedSubPerSt[$key][$vkey]['gradeRemark'] = $getGradeRemark('A');
                        break;
                    case  $totalScore >= 60 and  $totalScore <= 69:
                        $groupedSubPerSt[$key][$vkey]['grade'] = 'B';
                        $groupedSubPerSt[$key][$vkey]['gradeRemark'] = $getGradeRemark('B');
                        break;
                    case  $totalScore >= 59 and  $totalScore <= 50:
                        $groupedSubPerSt[$key][$vkey]['grade'] = 'C';
                        $groupedSubPerSt[$key][$vkey]['gradeRemark'] = $getGradeRemark('C');
                        break;
                    default:
                        $groupedSubPerSt[$key][$vkey]['grade'] = 'P';
                        $groupedSubPerSt[$key][$vkey]['gradeRemark'] = $getGradeRemark('P');
                }
            }
        }
        // we needed to fetch all students so we can determine the average, position in class etc, to properly calculate for a single student 
        // so this below  👇 will get single result...the main one getting the single result specifically

        $finaleSingleCourseResult = [];
        foreach ($groupedSubPerSt as $key => $value) {
            foreach ($value as $k => $v) {
                //use isset to eliminate not set or integer error
                // check if the student_id from the array is same with the student variable from request that we want to check for, if so, push them to $finaleSingleCourseResult array variable
                if (isset($v['student_id']) && $v['student_id'] === $student)
                    // need to append '[]' so that it can take more than on array item
                    $finaleSingleCourseResult[] = $v;
            }
        }
        // dd($finaleSingleCourseResult);

        return $finaleSingleCourseResult;
    }
    /* End of the main SINGLE RESULT CALCULATOR */

    public function yearlyResult($session = 1, $class = 1, $student_id = 1)
    {
        //group by session 
        // because student can't have more than 3 result per session...so yearl basically means 1st term, 2nd term, 3rd term for, e.g, 2021/2022 session
        //query: select all from students table where class = class, session == session, student_id == student group by term 
        //select * from `results` where `term_id` = 


        $finalYearlResult = [];
        $student = DB::table('results')->where('class_id', $class)->where('session_id', $session)->where('school_id', Admin::AdminSchool()->id)->where('student_id', $student_id)->get()->groupBy(['term_id']);
        // dump($student);
        $noOfTerms = count($student);
        $terms = [1, 2, 3];
        //how do I know when I'm working with a particular term ?
        foreach ($student as $term => $value) {
            //  dump($value->groupBy('subject'));
            $val = $value->toArray();

            foreach ($val as $k => $v) {

                if ($c = collect($val[$k])->contains($val[$k]->subject)) {
                    dump($val[$k]->subject);
                }
            }
            // $valueActualNumber = count($value) - 1;



            // dd($student[$term][0]);
            //  dd( $value->groupBy('subject')->toArray() );
            //             for ($i = 0; $i <  $valueActualNumber; $i++) {
            //                 foreach ($loop = $value->groupBy('subject')->toArray() as $k => $v) {
            //                     //consider the term right here 
            // dump($loop);
            //                     $student[$term][$k] = $student[$term][$valueActualNumber] ?? '';
            //                     unset( $student[$term][$valueActualNumber]);

            //                     dump($student[$term]);
            //                     break;
            //                 }
            //             }

            //loop the above 
            // I will need to target the term
            // I will also need to target the particular subject
            // then calucluate the total bearing in mind their respective terms

            //i will loop , then attach base on key (i.e subject) 
        }
    }
}
