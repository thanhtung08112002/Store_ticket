<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FlightRequest extends FormRequest
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
        if($request->isMethod('PUT')){
            $rule = [
                'airplane'=>'required',
                'flight_name'=>'required',
                'location_start'=>'required',
                'location_end'=>'required',
                'time_start'=>'required',
                'information'=>'required',
                'price'=>'required|numeric|integer|min:1',
                'image'=>'image',
            ];
        }else{
            $rule = [
                'airplane'=>'required',
                'flight_name'=>'required',
                'location_start'=>'required',
                'location_end'=>'required',
                'time_start'=>'required',
                'information'=>'required',
                'price'=>'required|numeric|integer|min:1',
                'image'=>'required|image',
            ];
        }
        
        return $rule;
    }
    public function messages()
    {
        return [
            'airplane.required'=>'Máy bay trống',
            'flight_name.required'=>'Tên bay trống',
            'location_start.required'=>'Địa điểm bắt đầu trống',
            'location_end.required'=>'Địa điểm kết thúc trống',
            'time_start.required'=>'Thời gian bắt đầu trống',
            'information.required'=>'Thông tin chuyến bay trống',
            'price.min'=>'Giá không được nhỏ hơn hoặc bằng 0',
            'price.numeric'=>'Giá phải là số',
            'price.required'=>'Giá trống',
            'image.required'=>'Ảnh trống',
            'image.image'=>'Ảnh không hợp lệ',
        ];
    }
}
