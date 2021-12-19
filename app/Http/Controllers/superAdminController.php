<?php

namespace App\Http\Controllers;

use App\Functions\Functions;
use App\Models\Admin;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class superAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all(); compact('admins');
        return view('dashboard.admin.index', compact('admins'));
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
            'phone' => 'required|max:15|unique:admins'
        ]);

        $user = User::create([
            'name' =>  $req->name,
            'email' => $req->email,
            'password' => $req->password = Hash::make(12345678)
        ]);

        $user->admin()->create([
            'school_id' => $req->school_id,
            'phone' => $req->phone
        ]);

        $user->assignRole('Admin');

        return redirect()->route('dashboard.admin.index');
    }
}
