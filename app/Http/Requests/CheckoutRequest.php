<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
    public function rules()
    {
        return [
            'fullname'=>'required',
            'birthday'=>'required',
            'address'=>'required',
            'passport'=>'required',
            'phone'=>'required',
            'email'=>'required|email',

        ];
    }
    public function messages()
    {
        return [
            'fullname.required'=>'Fullname không được trống',
            'birthday.required'=>'Birthday không được trống',
            'address.required'=>'Address không được trống',
            'passport.required'=>'Passport không được trống',
            'phone.required'=>'Số điện thoại không được trống',
            'email.required'=>'Email không được trống',
            'email.email'=>'Email không hợp lệ',
        ];
    }
}
