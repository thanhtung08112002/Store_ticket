<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AirplaneRequest extends FormRequest
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
    public function rules(Request $request)
    {

        return [
            'airplane_brand'=> 'required',
            'airplane_name' => 'required',
            'qty_seat'=> 'required|integer|min:1',
            'about'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'airplane_brand.required'=> 'Hãng bay không để trống',
            'airplane_name.required' => 'Tên máy bay không để trống',
            'qty_seat.required'=> 'Số chỗ không để trống',
            'qty_seat.min'=> 'Số chỗ không được âm hoặc bằng 0',
            'about.required'=> 'Thông tin về máy bay không để trống',
        ];
    }
}
