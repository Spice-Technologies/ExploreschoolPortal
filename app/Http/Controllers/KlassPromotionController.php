<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Klass;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KlassPromotionController extends Controller
{
    public function index()
    {

        $currentSession = Session::where('active', 1)->first()->id;

        $currently_logged_admin_id =  Admin::loggedInAdmin();
        // dd( $currently_logged_admin_id->id);
        // Laravel Eloquent Filter By Column of Relationship
        // This is just perfect for what I need. Get the number of classes to show by filtering base on the related Model conditions
        //simply saying "whereHas this condition, 
        //its simply a situation where the number of results from the start model reference 

        $classes = Klass::getClass($currentSession, $currently_logged_admin_id->id);


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


        //don't alow promotion of to same class
        if ($req->current_class == $req->next_class) {
            return redirect()->route('promote.klass.index')->with('error', 'Current class and next class should not be the same!');

            //prevent promotion to lesser class ---more like demoting
        } elseif ($req->current_class  >  $req->next_class) {
            return redirect()->route('promote.klass.index')->with('error', 'You are demoting ! cos  next class is, ' . $req->next_class . ' is less than the current class ' . $req->current_class);

            // prevent promotion to an upper class
        } elseif ($req->next_class != ($req->current_class + 1)) {
            return redirect()->route('promote.klass.index')->with('error', 'You are trying to double promote! You are promoting 2x ahead of the current class. It should be 1x. Next class, ' . $req->next_class . ', should not be 2x ahead of current class, ' . $req->current_class);
        }

        $student = new Student();
        // the school admin belongs to 
        $school = Admin::AdminSchool()->id;

        $currentSession = Session::where('active', 1)->first();

        //I had to use the DB facade so that I can know the status of the update

        /** What this query is doing 
         * make sure you are selecting from the student's table where the school admin belongs to the logged in admin
         * Where the session is the current session (this is a major delimiter to decide whether to promte the student or not)
         * /////TO avoid total error where the instead of promoting a class from say jss1 to jss 2, the app npw promotes or reasign student class say to sss1 or sss3 all in the attempt to use class promotion
         * this where statement solves that ....It checks if the current class is less than the next_class and if the current class is same as the next class (here we just did minus 1...jsut study the code)
         * the other aspect of inaccurate promotion or demotion is handle above 
          * 
        */
        $studentUpdate  = DB::table('students')->where('school_id', $school)->Where('session_id', '!=', $currentSession->id)->where('class_id', '<', $req->next_class)->Where('class_id', ($req->next_class - 1))->update([
            'class_id' => $req->next_class,
            'current_session' =>  $currentSession->session,
            'session_id' => $currentSession->id
        ]);

        if ($studentUpdate) {
            return redirect()->route('promote.klass.index')->with('msg', 'Klass promoted successfully');
        } else {
            $defaultKlasses = [1 => 'Jss 1', 2 => "Jss 2", 3 => 'Jss 3', 4 => 'SSS 1', 5 => 'SSS 2', 6 => 'SSS 3'];
            return redirect()->route('promote.klass.index')->with('error', 'Unfortunately. You dont have any student in ' .  $defaultKlasses[$req->current_class]);
        }

        // update([
        //     'class_id' => $req->class_id,
        //     'current_session' =>  $currentSession->session,
        //     'session_id' => $currentSession->id
        // ]);

        return redirect()->route('promote.klass.index')->with('msg', 'No worries! This class has already been promoted!!!');
    }
}
