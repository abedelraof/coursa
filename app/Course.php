<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";

    protected $primaryKey = "id";

    protected $fillable = ["name" , "hours" , "description" , "skills" , "language" ,
                           "image_path","teacher_id"];

    //relation between teacher and course in course model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    //relation between course and student_course in course model
    public function course_student()
    {
        return $this->hasMany('\App\CourseStudent','course_id');
    }
}
