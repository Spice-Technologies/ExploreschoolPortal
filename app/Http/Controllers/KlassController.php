<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class KlassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {

        $classes = Klass::all();
        return view('backend.class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Klass::all();
        return view('backend.class.create', compact('classes'));
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
            'class_id' => 'required|string|max:255',
            'subclass'          => 'required|string|max:1',
            'f_teacher_name' => 'required|string|max:45'
            // 'class_desc'    => 'required|string|max:255'

        ]);

        $admin_id = Admin::loggedInAdmin()->id;
        $school_id = Admin::AdminSchool()->id;
        $formTeacher = Teacher::create([
            'admin_id' => $admin_id,
            'name' => $request->f_teacher_name,
            'school_id' => $school_id,
        ]);
       

        $formTeacher->klasses()->attach([$request->class_id, '0']);

        //this style of inserting to the elated table below works with create()) method but doesnt work with save()..I don't think it is something I want to check now, but we move...
        // I should deal with this subclasses later
        // $klass->subClasses()->create([
        //     'subKlass_name' => $request->subclass,
        //     'sub_class_description' => 'This subclass was created from ' . $request->class
        // ]);
        return redirect()->route('class.create')->with('msg', "Classes were added successfully 🙂");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
    {
    }

    public function fetch(Request $req)
    {
        //find the students class
        if ($req->has('class_id') && empty($req->sub_class_id)) {
            $studentsClass = Student::where('class_id', $req->id)->get();
            return redirect()->route('class.index')->with(['studentsClass' => $studentsClass]);
        }
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
