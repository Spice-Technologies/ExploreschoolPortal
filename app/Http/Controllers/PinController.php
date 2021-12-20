<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pin;
use App\Models\School;
use App\Models\Session;
use Illuminate\Http\Request;

use function App\Http\Controllers\secure_random_string as ControllersSecure_random_string;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        $session = Session::first(); // i should write the code in away that it suggest also the session based on the current year of the calender
        return view('dashboard.pinRequest.create', compact('schools', 'session'));
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
            'school' => 'required|numeric', // actually school_id but to avoid FE validation error like 'school_id' is required....you get?
            'session' => 'required|numeric', // actually session_id 
        ]);
        //things to do :
        // get the no of pins via request payload
        //use the no of pins to determine the number of times  randomm alpha-numerics are generated
        // push each one saved to an array  probably use fill() or array_push()
        // take that array then serialised it
        //send the serialsed array into the db
        //finish !

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
        $allPins = [];
        for ($i = 0; $i < $request->pins; $i++) {
            $generatedPin =   secure_random_string(13);
            array_push($allPins, $generatedPin);
        }
        
        $pinModel = new Pin();
        $pinModel->pin = serialize($allPins);
        $pinModel->session_id = $request->session;
        $pinModel->school_id = $request->school;
        $pinModel->save();

        return redirect()->route('pin.index');
    }

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
