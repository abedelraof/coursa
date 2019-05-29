<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseStudent;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\SaveStudentRequest;
use App\Http\Requests\ShowStudentRequest;
use App\Student;
use App\User;
use function foo\func;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //students management page
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Student::orderBy('name', 'asc')->paginate(10);

        return view('admin.students.index',[
            "data" => $data
        ]);
    }

    //open form of Add students
    public function create()
    {
        $student = new Student();
        $courses = Course::all();
        return view('admin.students.form',[
            "student" => $student,
            "courses"=>$courses,
            "selected_courses"=>[]
        ]);
    }

    //open form of Add students
    public function edit(Student $student)
    {
        $selected_courses = $student->course_student->map(function ($item){
            return $item->course;
        });
        $courses= Course::get()->map(function ($item) use($selected_courses){
            $item->selected = false;
            foreach ($selected_courses as $course){
                if ($course->id == $item->id){
                    $item->selected = true;
                    break;
                }
            }
            return $item;
        });
        return view('admin.students.form',[
            "student" => $student,
            "courses"=>$courses,
            "selected_courses"=>$selected_courses
        ]);
    }

    //save students in database
    public function save(SaveStudentRequest $request)
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
                    $student = Student::find($request->id);

                    if ($student && $student->user)
                    {
                        // save students information.
                        $student->fill($request->all());
                        if (!$student->save())
                        {
                            throw new \Exception("Unexpected error occurred #201");
                        }
                        $userData=[
                            "name" => $student->name,
                            "email" => $request->email,

                        ];
                        if ($request->filled("password"))
                        {
                            $userData["password"] = Hash::make($request->password);
                        }
                        //save login information for students
                        $student->user->fill($userData);
                        if (!$student->user->save())
                        {
                            throw new \Exception("Unexpected error occurred #201");
                        }

                        //delete all relations from course_student table
                        CourseStudent::where("student_id",$student->id)->get()->map(function ($item){
                            $item->delete();
                        });
                        foreach ($request->course_id as $course_id)
                        {
                            $course_student = CourseStudent::create([
                                "course_id"=> $course_id,
                                "student_id" => $student->id
                            ]);

                        }


                        $request->session()->flash("success", "Student has been saved successfully!");
                        return redirect()->route("admin.students.index");
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
                    "type" => "student",
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                ]);
                //if create user success
                if ($user)
                {
                    //create student after user
                    $request->request->set("user_id", $user->id);
                    $student = Student::create($request->all());

                    //create course_student after student
                    $request->request->set("student_id" , $student->id);
                    foreach ($request->course_id as $course_id)
                    {
                        $student_course = CourseStudent::create([
                            "course_id"=> $course_id,
                            "student_id" => $request->student_id
                        ]);
                    }


                    if ($student && $student_course) {
                        $request->session()->flash("success", "Student has been saved successfully!");
                        return redirect()->route("admin.students.index");
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

        return redirect()->route("admin.students.index");
    }


    //delete students from database
    public function delete(DeleteStudentRequest $request)
    {
        $student = Student::find($request->id);
        //$student_course = CourseStudent::find($student->id);
        //give msg for success or fail delete students
        //check if user and student deleted
        if ($student)
        {
            if ($student->user->delete())
            {
                    if($student->delete())
                    {
                        $request->session()->flash("success" , "Teacher have been saved successfully");
                    }
            }
        }
        else
        {
            $request->session()->flash("error","Unexpected error occurred, could not delete students!");
        }

        return redirect()->route("admin.students.index");

    }

    //open form of Add students
    public function show(Student $student)
    {
        return view('admin.students.show',[
            "student" => $student
        ]);
    }
}
