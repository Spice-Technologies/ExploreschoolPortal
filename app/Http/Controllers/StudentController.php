<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->get();

        return view('backend.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.students.create');
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

        echo secure_random_string(12);
        $user = User::create([
            'name' => $request->name,
            'email' => 'EXP/21/0001',
            'password' => Hash::make($request->password = secure_random_string(10))
        ]);
        // this is how the user_id value in the students model is being inserted  
        $user->student()->create([
            'class_id' => $request->class_id,
            'parent_id' => 1,
            'reg_num' => 'EXP/21/0001',
            'gender' => $request->gender,
            'dateofbirth' => $request->dateofbirth,
            'lga' => $request->lga,
            'state' => $request->state,
            'country' => $request->country,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);
        $user->assignRole('Student');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
