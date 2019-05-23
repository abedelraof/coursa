<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteTeacherRequest;
use App\Http\Requests\SaveTeacherRequest;
use App\Teacher;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\DeclareDeclare;

class TeachersController extends Controller
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
        $data = Teacher::paginate(5);
        return view('admin.teachers.index', [
            "data" => $data
        ]);
    }

    public function create()
    {
        return view('admin.teachers.form', [
            "teacher" => new Teacher()
        ]);
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.form', [
            "teacher" => $teacher
        ]);
    }

    public function save(SaveTeacherRequest $request)
    {

        if ($request->hasFile("image")) {
            $extension = $request->image->getClientOriginalExtension();
            $photoName = time() . rand(1000, 9999) . '.' . $extension;
            // save image.
            $request->image->move(public_path('uploads'), $photoName);
            $request->request->set("image_path", "/uploads/" . $photoName);
        }

        return DB::transaction(function () use ($request) {

            if ($request->filled("id")) {
                // update current.
                if ($request->id > 0) {
                    $teacher = Teacher::find($request->id);
                    if ($teacher && $teacher->user) {
                        // save teacher.
                        $teacher->fill($request->all());
                        if (!$teacher->save()) {
                            throw new \Exception("Unexpected error occurred #201");
                        }
                        $teacher->user->fill([
                            "name" => $teacher->name,
                            "email" => $request->email,
                            "password" => Hash::make($request->password),
                        ]);
                        if (!$teacher->user->save()) {
                            throw new \Exception("Unexpected error occurred #201");
                        }
                        $request->session()->flash("success", "Teacher has been saved successfully!");
                        return redirect()->route("admin.teachers.index");
                    }
                }
            } else {
                // create new one.
                $user = User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "type" => "teacher"
                ]);
                if ($user) {
                    // 2 - create teacher.
                    // set user_id -> to user->id
//                    $teacher = Teacher::create(array_merge([
//                        "user_id" => $user->id
//                    ], $request->all()));
                    $request->request->set("user_id", $user->id);
                    $teacher = Teacher::create($request->all());
                    if ($teacher) {
                        $request->session()->flash("success", "Teacher has been saved successfully!");
                        return redirect()->route("admin.teachers.index");
                    } else {
                        throw new \Exception("Unexpected error occurred #102");
                    }
                } else {
                    throw new \Exception("Unexpected error occurred #101");
                }
            }
        });
        return redirect()->back();
    }

    public function delete(DeleteTeacherRequest $request)
    {
        $model = Teacher::find($request->id);
        $status = $model->delete();
        if ($status) {
            $request->session()->flash("success", "Teacher has been deleted successfully!");
        } else {
            $request->session()->flash("error", "Unexpected error occurred, could not delete teacher!");
        }
        return redirect()->back();
    }

    public function api_index()
    {
        return Teacher::get();
    }

}
