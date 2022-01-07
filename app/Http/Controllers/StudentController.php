<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Student;
use App\Models\SubKlass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
 /*
     Hiii..I used my own ceated static functions, Admin::AdminSchool() to always get the the school that the admin belongs to

     I also used scoped queries to avoid repeatition of where clauses that has to do with fetching the school the user is related to

   
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->has('class_id')) {
            //if you use get(), you may not always have your errors thrown but try to be more specific with something like first() as away to debug your code
            $studentsClass = Student::where('class_id', $req->class_id)->where('school_id', Admin::AdminSchool())->get();
         
            $classes = Klass::all();
            return view('backend.students.index', compact('classes', 'studentsClass'));
        }
        $classes = Klass::all();
        $studentsClass = Student::SchoolId(Admin::AdminSchool())->get();
        return view('backend.students.index', compact('classes', 'studentsClass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes =  Klass::get();
        $subclasses =  SubKlass::get();
        return view('backend.students.create', compact('classes', 'subclasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id'          => 'required|numeric',
            'gender'            => 'required|string',
            'dateofbirth'       => 'required|date',
            'current_address'   => 'required|string',
            'permanent_address' => 'required|string',

        ]);

        //dd($request->all());
        // $request->email = "admin@explore.com"; 

        function secure_random_string($length)
        {
            $random_string = '';
            for ($i = 0; $i < $length; $i++) {
                $number = random_int(0, 36);
                $character = base_convert($number, 10, 36);
                $random_string .= $character;
            }

            return $random_string;
        }

        //echo secure_random_string(12);
        $user = User::create([
            'name' => $request->name,

            'password' => $request->password = 12345678
        ]);
        // this is how the user_id value in the students model is being inserted  

        function reg_number($id)
        {
            $regNum = '';
            $uniqueId = str_pad($id, 4, '0', STR_PAD_LEFT);
            $date = date('y');
            $regNum = "EXP" . '\\' . $date . '\\' . $uniqueId;
            return $regNum;
        };

        $reg_numDemo = secure_random_string(2);
        // refactor this code with the fill() method, chidi 
        $user->student()->create([
            'class_id' => $request->class_id,
            'parent_id' => 1,
            'SubKlass_id' => $request->Sub_Class_id,
            'gender' => $request->gender,
            'dateofbirth' => $request->dateofbirth,
            'lga' => $request->lga,
            'state' => $request->state,
            'country' => $request->country,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'school_id' => Admin::AdminSchool(), //check the admin model to see how this is working 
        ]);

        $user->assignRole('Student');

        $user->student->reg_num = reg_number($user->student->id);
        $user->student->save();
        $user->email = reg_number($user->student->id);
        $user->save();
        return redirect()->route('student.index');
    }
    //so cards can be used to login but validates depending on the number of times used...if the students buys new card, the card login will be changed
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //check for the student in class
    }

    public function fetch($id)
    {
        //check for the student in class
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $classes = Klass::latest()->get();
        $subclasses = SubKlass::latest()->get();
        return view('backend.students.edit', compact('student', 'classes', 'subclasses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id'          => 'required|numeric',
            'gender'            => 'required|string',
            'dateofbirth'       => 'required|date',
            'current_address'   => 'required|string',
            'permanent_address' => 'required|string',

        ]);

        $student->user()->update([
            'name' => $request->name
        ]);

        $student->update([
            'class_id'          => $request->class_id,
            'gender'            => $request->gender,
            'dateofbirth'       => $request->dateofbirth,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address,

        ]);

        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
