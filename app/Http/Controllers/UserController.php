<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\SaveUserRequest;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::orderBy('name', 'asc')->paginate(10);

        return view('admin.users.index',[
            "data" => $data,
        ]);
    }

    public function create()
    {
        return view('admin.users.form',[
            "user" => new User()
        ]);
    }

    public function save(SaveUserRequest $request)
    {
        $status = User::create([
            "name" => $request->name,
            "type"=> "admin",
            "email" => $request->email,
            "password" => Hash::make($request->password),
            ]
            );

        if ($status)
        {
            $request->session()->flash("success" , "User have been saved successfully");
        }
        else
        {
            $request->session()->flash("error","Unexpected error occurred, could not delete user!");
        }

        return redirect()->route("admin.users.index");
    }
}
