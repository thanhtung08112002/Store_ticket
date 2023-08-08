<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $req)
    {
        switch ($req->method) {
            case "POST":
                $rules =  [
                    'email' => 'email|required',
                    'password' => 'required'
                ];
                break;
            default:
                return [];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'email.required' => 'Email trống',
            'email.email' => 'Email không hợp lệ',
            'password' => 'Mật khẩu trống'
        ];    
    }
}
