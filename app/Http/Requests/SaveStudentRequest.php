<?php

namespace App\Http\Requests;

use App\Student;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SaveStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *"image_path" => "nullable|string",
     * @return array
     */
    public function rules()
    {
        //dd($_REQUEST);
        $user_id = 0;
        if ($this->id)
        {
            $student = Student::find($this->id);
            if($student)
            {
                $user_id = $student->user_id;
            }
        }
        return [
            "name" => "required",
            "national_id" => "required|numeric|digits:9",
            "date_of_birth" => "nullable|date",
            "mobile" => "nullable|numeric",
            "email" => ["required","email",Rule::unique("users")->ignore($user_id)],
            "password" => "required_without:id|confirmed",
            "password_confirmation" => "nullable",
        ];
    }
}
