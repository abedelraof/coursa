<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $table = "students";
    protected $primaryKey = "id";

    protected $fillable = ["name", "date_of_birth", "mobile", "national_id"];




}
