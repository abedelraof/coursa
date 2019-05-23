<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        return [
            "name" => "required",
//            "national_id" => "required|numeric|digits:9",
            "national_id" => "required|numeric",
//            "date_of_birth" => "nullable|date|before_or_equal:16years ago",
            "date_of_birth" => "nullable|date",
            "mobile" => "nullable|numeric",
            "email" => "required|email",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
        ];
    }
}
