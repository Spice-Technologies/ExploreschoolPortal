<?php

namespace App\Http\Controllers;

use App\Functions\Functions;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class superAdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.index');
    }


    public function AdminCreate()
    {
      
        $schools = School::all();
        return view('dashboard.admin.create', compact('schools'));
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
            'password' => $req->password = 12345678
        ]);

        $user->admins()->create([
            'school_id' => $req->class_id,
            'phone' => $req->phone
        ]);        
    }
}
