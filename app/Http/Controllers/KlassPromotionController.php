<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;

class KlassPromotionController extends Controller
{
    public function index()
    {

        $currentSession = Session::where('active', 1)->first()->id;

        $loggedInAdmin =  Admin::loggedInAdmin();
        // Laravel Eloquent Filter By Column of Relationship
        // This is just perfect for what I need. Get the number of classes to show by filtering base on the related Model conditions
        //simply saying "whereHas this condition, 
        //its simply a situation where the number of results from the start model reference 
        $classes = Klass::whereHas(
            'student',
            function ($query) use ($currentSession) {
                $query->where('session_id', $currentSession);
            }
        )->get(['id', 'class_name'])->toArray();

        $promotedClass = [];
        $defaultKlasses = ['Jss 1' => 1, 'Jss 2' => 2, 'Jss 3' => 3, 'SSS 1' => 4, 'SSS 2' => 5, 'SSS 3' => 6];
        $ids = [];
        foreach ($classes as $key => $class) {

            if (in_array($class['id'], $defaultKlasses)) {
                // pass the promoted ids and class name as keys below
                $promotedClass['promoted'][$class['class_name']] = $class['id'];
                // remove the class (id) that has already being promoted from the final class collector arrary
                $defaultKlasses  = array_diff($defaultKlasses, [$class['id']]);
            }
        }

        $classes = array_merge($promotedClass, $defaultKlasses);

        return view('backend.promotion.klasspromotion.index', compact('classes'));
    }


    public function promote(Request $req)
    {
        // dd($req->all());
        $req->validate([

            // 'class_id' => 'required',

            'current_class' => 'required',
            'next_class' => 'required'
        ]);



        if ($req->current_class == $req->next_class) {
            return redirect()->route('promote.klass.index')->with('error', 'Current class and next class should not be the same!');
            //check if the next class is greater than the current class by one. so they don't promote say from jss2 to ss1
        } elseif ($req->current_class  >  $req->next_class) {
            return redirect()->route('promote.klass.index')->with('error', 'You are demoting ! cos  next class is, ' . $req->next_class . ' is less than the current class ' . $req->current_class);
        } elseif ($req->next_class != ($req->current_class + 1)) {
            return redirect()->route('promote.klass.index')->with('error', 'You are trying to double promote! You are promoting 2x ahead of the current class. It should be 1x. Next class, ' . $req->next_class . ', should not be 2x ahead of current class, ' . $req->current_class);
        }

        $student = new Student();
        // from the top of my head
        $school = Admin::AdminSchool()->id;

        $currentSession = Session::where('active', 1)->first();

        //get the existing session 
        //obviously I'm having date issues here
        $student->whereNull('session_id')->where('school_id', $school)->orWhere('session_id', '!=', $currentSession->id)->update([
            'class_id' => $req->class_id,
            'current_session' =>  $currentSession->session,
            'session_id' => $currentSession->id
        ]);

        if (isset($student)) {
            return redirect()->route('promote.klass.index')->with('msg', 'No worries! This class has already been promoted!!!');
        }


        return redirect()->route('promote.klass.index')->with('msg', 'Klass promoted successfully');
    }
}
