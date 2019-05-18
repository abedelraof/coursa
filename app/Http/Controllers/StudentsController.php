<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\SaveStudentRequest;
use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except("api_index");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Student::paginate(5);
        return view('admin.students.index', [
            "data" => $data
        ]);
    }

    public function create()
    {
        return view('admin.students.form', [
            "student" => new Student()
        ]);
    }

    public function edit(Student $student)
    {
        return view('admin.students.form', [
            "student" => $student
        ]);
    }

    public function save(SaveStudentRequest $request)
    {
        $status = Student::updateOrCreate([
            "id" => $request->id
        ], $request->all());
        if ($status) {
            $request->session()->flash("success", "Student has been saved successfully!");
        } else {
            $request->session()->flash("error", "Unexpected error occurred, could not save student!");
        }
        return redirect()->route("admin.students.index");
    }

    public function delete(DeleteStudentRequest $request)
    {
        $model = Student::find($request->id);
        $status = $model->delete();
        if ($status) {
            $request->session()->flash("success", "Student has been deleted successfully!");
        } else {
            $request->session()->flash("error", "Unexpected error occurred, could not delete student!");
        }
        return redirect()->back();
    }

    public function api_index(){
        return Student::get();
    }

}
