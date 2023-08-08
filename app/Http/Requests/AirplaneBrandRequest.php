<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirplaneBrandRequest extends FormRequest
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
            'name'=>'required',
            'information'=>'required',    
        ];
    }
    public function messages()
    {
        
        return [
            'name.required'=>'Tên không được trống',
            'information.required'=>'Thông tin không được trống',    
        ];
    }
}
