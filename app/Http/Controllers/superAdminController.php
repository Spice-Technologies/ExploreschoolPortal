<?php

namespace App\Http\Controllers;

use App\Functions\Functions;
use App\Models\Admins;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class superAdminController extends Controller
{
    public function index()
    {
       // $admins = Admins::all(); compact('admins')
        return view('dashboard.admin.index');
    }


    public function AdminCreate()
    {
      
       // $schools = School::all(); compact('schools')
        return view('dashboard.admin.create');
    }

    public function addAdmin(Request $req)
    {
        // Functions::secure_random_string($length);
        $req->validate([
            'name' => 'required|string|max:255',
            'school_id'          => 'required|numeric',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|max:13'
        ]);

        $user = User::create([
            'name' =>  $req->name,
            'email' => $req->name,
            'password' => $req->password = Hash::make(12345678)
        ]);

        $user->admin->create([
            'school_id' => $req->class_id,
            'phone' => $req->phone
        ]); 
        $user->assignRole('Admin');

        return redirect()->route('dashboard.admin.index');       
    }
}
