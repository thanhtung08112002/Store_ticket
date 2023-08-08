<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterRequest extends FormRequest
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
                    'username'=> 'required',
                    'email' => 'email|required|unique:users,email',
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
            'username.required' => 'Họ tên trống',
            'email.required' => 'Email trống',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không hợp lệ',
            'password' => 'Mật khẩu trống'
        ];    
    }
}
