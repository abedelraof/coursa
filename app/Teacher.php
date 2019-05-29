<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "teachers";

    protected $primaryKey = "id";

    protected $fillable = ["name" , "date_of_birth" , "national_id" , "mobile"  ,"image_path" ,
                           "user_id"];

    public function user()
    {
        return $this->belongsTo('\App\User','user_id');
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
