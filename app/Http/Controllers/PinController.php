<?php

namespace App\Http\Controllers;

use App\Exports\PinDownload;
use App\Models\Admin;
use App\Models\Pin;
use App\Models\School;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as msgSession;
use Maatwebsite\Excel\Facades\Excel;

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
        $pins = Pin::all();
        return view('dashboard.superAdmin.pinRequest.index', compact('pins'));
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
        return view('dashboard.superAdmin.pinRequest.create', compact('schools', 'session'));
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
            'session' => 'required|numeric',
            'pins' => 'required|numeric',


        ]);
        //things to do :
        // get the no of pins via request payload
        //use the no of pins to determine the number of times  randomm alpha-numerics are generated
        // push each one saved to an array  probably use fill() or array_push()
        // take that array then serialised it
        //send the serialsed array into the db
        //finish !
        // not finish yet..
        //lets prevent the form from generatingpin twice either by misake or anyting 

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

        $pinModel = new Pin();
        // check if pins have been generated for this school before
        $mainPin = Pin::select('*')->where('school_id', $request->school)
            ->where('generated', '1')
            ->where('session_id', $request->session)
            ->first();
        if (!$mainPin) {

            for ($i = 0; $i < $request->pins; $i++) {
                
                $pinModel->pin = secure_random_string(15);
                $pinModel->session_id = $request->session;
                $pinModel->school_id = $request->school;
                $pinModel->generated = 1;
                $pinModel->save();
            }
            return redirect()->route('pin.index');
        } else {
            return back()->with('msg', 'Oops! We have already generated pins for the school, ' . $mainPin->school->school . ', for ' . $mainPin->session->session . ' session !');
        }
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

    //  this is for downloading the excel 
    public function download(Pin $pin)
    {
        // this right here will select the specific row that fits the specified condition from the where clause
        $pinRows = Pin::where('school_id', $pin->school_id)
            ->where('session_id', $pin->session_id)
            ->where('generated', $pin->generated)
            ->get();
        $pins = [];
        foreach ($pinRows as $pinRow) {
            $pinner = $pinRow->pin;
            array_push($pins, $pinner);
        }

        //the actually result is passed down to the excel exporting class,PinDownload
        return (new  PinDownload($pins, $pin->school->school_id))->download($pin->school->school_id . '.csv');
    }
}
