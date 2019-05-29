<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $table = "course_student";

    protected $primaryKey = "id";

    protected $fillable = ["course_id" , "student_id"];

    public function course()
    {
        return $this->belongsTo('\App\Course','course_id');
    }

    public function student()
    {
        return $this->belongsTo('\App\Student','student_id');
    }
}
