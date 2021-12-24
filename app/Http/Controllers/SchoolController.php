<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        return view('dashboard.school.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.school.create');
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
            'school' => 'required|string|max:255',
            'owner'          => 'required|string|max:255',
            'email'    => 'required|string|unique:schools',
            'phone' => 'required|string|max:15|unique:schools',
            'contact_addr' => 'required|string',
            'lga' => 'required|string',
            'state' => 'required|string',
           // 'website' => 'required|string',
        ]);
        $school = new School();
        $school->active = 1;
    
        $school->fill([
            'school' => $request->school,
            'owner' => $request->owner,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_addr' => $request->contact_addr,
            'lga' => $request->lga,
            'state' => $request->state,
            'website' => $request->website,
        ]);
        $school->save();

        return redirect()->route('school.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        $admin = Admin::where('school_id', $school->id)->first();
        $Adminpass = Crypt::decryptString($admin->user->password);
        return view('dashboard.school.show', compact('school','admin', 'Adminpass'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
       
        return view('dashboard.school.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School  $school)
    {
        $request->validate([
            'school' => 'required|string|max:255',
            'owner'          => 'required|string|max:255',
            'email'    => 'required|string',
            'phone' => 'required|string|max:15',
            'contact_addr' => 'required|string',
            'lga' => 'required|string',
            'state' => 'required|string',
           // 'website' => 'required|string',

        ]);

        $school->update([
            'school' => $request->school,
            'owner' => $request->owner,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_addr' => $request->contact_addr,
            'lga' => $request->lga,
            'state' => $request->state,
            'website' => $request->website,

        ]);

        return redirect()->route('school.index');
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
