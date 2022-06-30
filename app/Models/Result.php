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

        $arrColum = array_unique(array_column($array, 'name'));

        $arr = (array_unique(array_column($this->carrier, 'id')));


        // dd(in_array('Jane Doe',$arrColum));
        $i = 0;
        $new_array = [];
        foreach ($this->carrier as $key => $value) {

            // dd($this->carrier);


            //if preg_match, return all the matches
            if ($value['RegNum'] == 'Mob\22\0001') {
                //then filter where all Mob\22\0001 and save 
                $key = $value['RegNum'];
                $new_array += [$key => $value];

                $i++;
            }
        }
        $oldArr = [];
        $searched = [];
        // dd($arr);
        // dd($this->carrier);
        // break down 
        /* 
            Assign the arrays keys to the different Ids to make them unique

        
        */
        // foreach ($arr as $key => $value) {

        //     $oldArr[$value] = $this->carrier[$key];

        //     // if ($oldArr[$key] == $this->carrier[$key]['RegNum']) {
        //     //     $searched[] = $this->carrier[$key];
        //     // }
        // }

        // dd($oldArr);



        $array = [
            [
                "menu_id" => "1",
                "menu_name" => "Clients",
                "submenu_name" => "Add",
                "submenu_link" => "clients/add"
            ],
            [
                "menu_id" => "1",
                "menu_name" => "Clients",
                "submenu_name" => "List",
                "submenu_link" => "clients"
            ],
            [
                "menu_id" => "2",
                "menu_name" => "Products",
                "submenu_name" => "List",
                "submenu_link" => "products"
            ],
        ];

        /*
        Basically, where the menu_id == 1 / similar menu id, get all the submenu into one menu_id(1) container 
        */

        // dd($array);

        //Grouping submenus to their menus

        $menu =  array_reduce($array, function ($accumulator, $item) {

            $index = $item['menu_name']; //clients, 

            if (!isset($accumulator[$index])) {

                $accumulator[$index] = [
                    'menu_id' => $item['menu_id'],
                    'menu_name' => $item['menu_name'],
                    'submenu' => []
                ];
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
            $accumulator[$index]['submenu'][] = [
                'submenu_name' => $item['submenu_name'],
                'submenu_link' => $item['submenu_link']
            ];

            // dd($accumulator);

            return $accumulator;
        }, []);

        // dd($menu);

        //let me write my onw 

        $myOwn = array_reduce($this->carrier, function ($accumulator, $item) {

            $index = $item['RegNum']; // Mob220001
//this if it is not set is really doing the majic --Omorrrr!!!
            if (!isset($accumulator[$index])) {
                $accumulator[$index]= [
                    'id' => $item['id'],
                    'RegNum' => $item['RegNum'],
                    'submenu' => [],
                ];
            }
            $accumulator[$index]['submenu'][] = [
                'id' => $item['id'],
                'total_score' => $item['total_score'],
                'subject' => $item['subject']['subject'],
                'subject_id' => $item['subject_id']
            ];

            // dd($accumulator);

            return $accumulator;
        }, []);

        dd($myOwn);

        /*
        Code comment:
        1. Start the accumulator with an empty array instead of the default null
        2. get the index or identifier for the grouping you want
        3. then create a new array with that identifier as your starting key while assigning new assoc array and items to it:  new keys and the values  
        4. then add an array to  the  submenu array inside index array 
        no 4 is the unique identifier so all indexes with clients index for example will be grouped togther
        */



        dd(array_values($menu));
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
