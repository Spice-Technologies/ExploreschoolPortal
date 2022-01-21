<?php

namespace App\Http\Controllers;

use App\Functions\Functions;
use App\Models\Admin;
use App\Models\School;
use App\Models\Session;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class superAdminController extends Controller
{
    public function index()
    {

        $schools = School::count();
        $admins = Admin::count();
        $students = Student::count();
        $session = Session::first();

        return view('dashboard.superAdmin.index', compact('schools', 'session', 'admins', 'students'));
    }


    public function ViewAdmin()
    {

        $admins = Admin::all();
        return view('dashboard.superAdmin.admin.index', compact('admins'));
    }


    public function AdminCreate()
    {

        $schools = School::all();
        return view('dashboard.superAdmin.admin.create', compact('schools'));
    }

    public function addAdmin(Request $req)
    {
        // Functions::secure_random_string($length);

        // $password = Functions::secure_random_string(8);
        // $password = Hash::make($password);
        

        $req->validate([
            'name' => 'required|string|max:255',
            'school_id'          => 'required|numeric',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|max:15|unique:admins'
        ]);

        $user = User::create([
            'name' =>  $req->name,
            'email' => $req->email,
            'password' => Hash::make(12345678)
        ]);

        $user->admin()->create([
            'school_id' => $req->school_id,
            'phone' => $req->phone
        ]);

        $user->assignRole('Admin');


        return redirect()->route('dashboard.admin.view')->with('msg', 'Admin created successfully');
    }

    public function updateAdmin(Request $req, Admin $admin)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'school_id'          => 'required|numeric',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|max:15|unique:admins'
        ]);

    
        $admin->update([
            'name' =>  $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);



    }
}
