<?php

namespace App\Http\Requests;

use App\Teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SaveTeacherRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        //in edit mode to not duplicate email and password
        $user_id = 0;
        if ($this->id)
        {
            $teacher = Teacher::find($this->id);
            if($teacher)
            {
                $user_id = $teacher->user_id;
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
