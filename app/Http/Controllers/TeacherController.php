<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\DeleteTeacherRequest;
use App\Http\Requests\SaveTeacherRequest;
use App\Teacher;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Teacher::orderBy('name', 'asc')->paginate(10);
        return view('admin.teachers.index',[
            "data" => $data
        ]);

    }

    public function create()
    {
        return view('admin.teachers.form',[
            "teacher" => new Teacher()
        ]);
    }

    public function save(SaveTeacherRequest $request)
    {
        //if user upload image
        if ($request->hasFile("image"))
        {
            $extension = $request->image->getClientOriginalExtension();
            $photoName = time() . rand(1000, 9999) . '.' . $extension;
            // save image.
            $request->image->move(public_path('uploads'), $photoName);
            $request->request->set("image_path", "/uploads/" . $photoName);
        }

        //callback function to add or update students
        return DB::transaction(function () use ($request)
        {
            //if the students exist in system
            if ($request->filled("id"))
            {
                //make update
                if($request->id > 0)
                {
                    $teacher = Teacher::find($request->id);
                    if ($teacher && $teacher->user)
                    {
                        // save students information.
                        $teacher->fill($request->all());
                        if (!$teacher->save())
                        {
                            throw new \Exception("Unexpected error occurred #201");
                        }
                        //save login information for students
                        $userData=[
                            "name" => $teacher->name,
                            "email" => $request->email,

                        ];
                        if ($request->filled("password"))
                        {
                            $userData["password"] = Hash::make($request->password);
                        }
                        $teacher->user->fill($userData);

                        if (!$teacher->user->save())
                        {
                            throw new \Exception("Unexpected error occurred #201");
                        }
                        $request->session()->flash("success", "Teacher has been saved successfully!");
                        return redirect()->route("admin.teachers.index");
                    }
                }
            }
            //if students dose not exist in the system
            else
            {
                //create new user & new students
                //first create new user
                $user = User::create([
                    "name" => $request->name,
                    "type" => "teacher",
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                ]);
                //if create user success
                if ($user)
                {
                    $request->request->set("user_id", $user->id);
                    $teacher = Teacher::create($request->all());
                    if ($teacher) {
                        $request->session()->flash("success", "Teacher has been saved successfully!");
                        return redirect()->route("admin.teachers.index");
                    } else {
                        throw new \Exception("Unexpected error occurred #102");
                    }
                }
                //if create user fail
                else
                {
                    throw new \Exception("Unexpected error occurred #101");
                }
            }
        });

        return redirect()->route("admin.teachers.index");
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.form',[
            "teacher" => $teacher
        ]);
    }

    public function delete(DeleteTeacherRequest $request)
    {
        $teacher = Teacher::find($request->id);

        if ($teacher)
        {
            if ($teacher->user->delete())
            {
                if($teacher->delete())
                {
                        $request->session()->flash("success" , "Teacher have been saved successfully");
                }
            }
        }
        else
        {
            $request->session()->flash("error","Unexpected error occurred, could not delete teacher!");
        }

        return redirect()->route("admin.teachers.index");

    }

    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show',[
            "teacher" => $teacher,
        ]);
    }
}
