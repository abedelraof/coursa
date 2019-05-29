<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\DeleteCourseRequest;
use App\Http\Requests\SaveCourseRequest;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Course::orderBy('name', 'asc')->paginate(10);
        return view('admin.courses.index',compact('data'));

        /*return view('admin.courses.index',[
            "data" => $data
        ]);*/
    }

    public function create()
    {
        $course = new Course();
        $teachers = Teacher::all();
       return view('admin.courses.form',compact('course','teachers'));
    }

    public function save(SaveCourseRequest $request)
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

        $status = Course::updateOrCreate([
            "id" => $request->id
        ],  $request->all());

        if ($status)
        {
            $request->session()->flash("success" , "Course have been saved successfully");
        }
        else
        {
            $request->session()->flash("error","Unexpected error occurred, could not delete courses!");
        }

        return redirect()->route("admin.courses.index");

    }

    public function edit(Course $course)
    {
        $teachers = Teacher::all();
        return view('admin.courses.form',[
            "course" => $course,
                "teachers" => $teachers
        ]);
    }

    public function delete(DeleteCourseRequest $request)
    {
        $status = Course::find($request->id)->delete();

        if ($status)
        {
            $request->session()->flash("success" , "Course have been saved successfully");
        }
        else
        {
            $request->session()->flash("error","Unexpected error occurred, could not delete courses!");
        }

        return redirect()->route("admin.courses.index");

    }

    public function show(Course $course)
    {
        return view('admin.courses.show',[
            "course" => $course
        ]);
    }
}
