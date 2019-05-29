<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";

    protected $primaryKey = "id";

    protected $fillable = ["name" , "date_of_birth" , "national_id" , "mobile", "image_path" ,
                           "user_id"];

    //relation between user and student in student model
    public function user()
    {
        return $this->belongsTo('\App\User','user_id');
    }


    //relation between student and student_course in course model
    public function course_student()
    {
        return $this->hasMany('\App\CourseStudent','student_id');
    }
}
