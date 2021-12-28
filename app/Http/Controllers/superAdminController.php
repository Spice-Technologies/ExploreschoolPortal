<?php

namespace App\Http\Controllers;

use App\Functions\Functions;
use App\Models\Admin;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class superAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all(); 
        return view( 'dashboard.superAdmin.admin.index' , compact('admins'));
    }

    public function AdminCreate()
    {

        $schools = School::all();
        return view('dashboard.superAdmin.admin.create', compact('schools'));
    }

  private function secure_random_string($length)
    {
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }

        return $random_string;
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
            'password' => Hash::make($req->password)
        ]);

        $user->admin()->create([
            'school_id' => $req->school_id,
            'phone' => $req->phone
        ]);

        $user->assignRole('Admin');


        return redirect()->route('dashboard.admin.index');
    }
}
