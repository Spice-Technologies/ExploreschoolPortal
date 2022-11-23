<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndividualPromotionController extends Controller
{
    public function index()
    {
        //promoted students
        //where session  === current session
        $admin = new Admin();
        $defaultKlasses = [1 => 'Jss 1', 2 => "Jss 2", 3 => 'Jss 3', 4 => 'SSS 1', 5 => 'SSS 2', 6 => 'SSS 3'];
        $currentSession = Admin::current_session();

        $students = Admin::admin_students()->where('session_id', '!=', $currentSession->id)->where('class_id', '!=', 7);

        if (count($students) < 1) {

            $warning = "Hi 👋, no student here ! All students have  been promoted successfully 😇";
            return view('backend.promotion.individual.index', compact('students', 'defaultKlasses', 'warning'));
        }
        // return every student in the school that the admin belongs to  
        return view('backend.promotion.individual.index', compact('students', 'defaultKlasses'));
    }

    public function promote(Request $req)
    {


        $req->validate([
            'next_class_id' => 'required',
        ]);
        $school = Admin::AdminSchool()->id;
        $currentSession = Admin::current_session();
        // i should move the code below to promotion model file since its moslty repeated 
        $promoteIndividual = DB::table('students')->where('school_id',  $school)->where('class_id', ($req->next_class_id - 1))->where('session_id', '!=',  $currentSession->id)->where('class_id', '<=', 6)->update([
            'class_id' => $req->next_class_id,
            'current_session' =>  $currentSession->session,
            'session_id' => $currentSession->id
        ]);
        //check if that student has been promoted before
        // any promoted student will have a side indcator that says "promoted" and disabled button by default -so no action can be taken 
        if ($promoteIndividual) {
            return redirect()->route('promote.individual.index')->with('msg', 'Student was successfuly promoted to next class');
        } else {
            //instead of this message, I can't just eliminate people who have not be promoted already right ?
            return redirect()->route('promote.individual.index')->with('error', 'Student is promoted already. Please check current session/year column');
        }
    }
}
