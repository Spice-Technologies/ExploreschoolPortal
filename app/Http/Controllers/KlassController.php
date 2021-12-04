<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\Student;
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
        // fetch all students in JSS1A
        // $klass =Klass::where('class_name', 'JSS1')->findOrFail(1);
        // $students=Student::where('gender', 'female')->findOrFail(1);

        // dd($students);
        if ($req->has('class_id')) {
            //if you use get(), you may not always have your errors thrown but try to be more specific with something like first() as away to debug your code
            $studentsClass = Student::where('class_id', $req->class_id)->get();
            // return redirect()->route('student.index')->with(['studentsClass' => $studentsClass]);
            $classes = Klass::all();
            return view('backend.students.index', compact('classes', 'studentsClass'));
        }
        $classes = Klass::all();
        $studentsClass = Student::all();

        return view('backend.students.index', compact('classes', 'studentsClass'));
        //this apporach (adding with an if statement for situations)i used now for this kind of situation where we have to fetch  results in the same blade and have a default display stuff from the contoller is actually the best
        if ($req->has('class_id')) {
            //if you use gt(), you may not always have your errors thrown but try to be more specific with something like first() as away to debug your code
            $studentsClass = Student::where('class_id', $req->class_id)->get();
            return redirect()->route('class.index')->with(['studentsClass' => $studentsClass]);
        }
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
        return view('backend.class.create');
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
            'class' => 'required|string|max:255',
            'subclass'          => 'required|string|max:1',
            'class_desc'    => 'required|string|max:255'

        ]);


        $klass = Klass::create([
            'class_name' => $request->class,
            'class_description' => $request->class_desc,

        ]);

        //this style of inserting to the elated table below works with create()) method but doesnt work with save()..I don't think it is something I want to check now, but we move...

        $klass->subClasses()->create([
            'subKlass_name' => $request->subclass,
            'sub_class_description' => 'This subclass was created from ' . $request->class
        ]);
        return redirect()->route('class.index');
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
