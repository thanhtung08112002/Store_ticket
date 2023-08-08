<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlightRequest;
use App\Models\AirplaneModel;
use App\Models\BetweenFlightAirplaneModel;
use App\Models\FlightModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FlightController extends Controller
{
    public function index()
    {
        $list = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')->orderBy('flight.created_at', 'DESC')->get(['flight.id', 'airplane.airplane_name', 'flight.name', 'airplane.qty_seat', 'flight.location_start', 'flight.location_end', 'flight.time_start', 'flight.type_way', 'flight.information', 'flight.price', 'flight.status', 'flight.created_at', 'flight.updated_at', 'flight.image']);
        return view('content.flight.index', compact('list'));
    }
    public function formAdd()
    {
        $listAirplane = DB::table('airplane')->join('airplane_brand', 'airplane_brand.id', '=', "airplane.airplane_brand_id")->where('airplane.status', 1)->orderBy('airplane.airplane_brand_id', 'DESC')->get(['airplane.id', 'airplane.airplane_name', 'airplane_brand.name']);
        return view('content.flight.formAdd', compact('listAirplane'));
    }
    public function add(FlightRequest $request)
    {
        $paramsFlight = ['name' => $request->flight_name, 'location_start' => $request->location_start, 'location_end' => $request->location_end, 'time_start' => $request->time_start, 'type_way' => $request->type_way, 'information' => $request->information, 'price' => $request->price, 'status' => $request->status];

        $check = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->where('flight.name', $request->flight_name)->where('between_flight_airplane.airplane_id', $request->airplane)->first();
        if (!is_null($check)) {
            toastr()->error('Máy bay của hãng hàng không hiện đã tồn tại');
            return redirect()->back();
        }
        if ($request->hasFile('image')) {
            $paramsFlight['image'] = uploadFile('upload', $request->image);
        }
        $insertFlight = FlightModel::create($paramsFlight);
        $paramsBetween = [
            'flight_id' => $insertFlight->id,
            'airplane_id' => $request->airplane,
        ];

        $insertBetween = BetweenFlightAirplaneModel::create($paramsBetween);
        session()->flash('success', 'Thêm thành công');
        return redirect()->route('admin.flight.index');
    }


    public function formEdit($id)
    {
        $listAirplane = DB::table('airplane')->join('airplane_brand', 'airplane_brand.id', '=', "airplane.airplane_brand_id")->where('airplane.status', 1)->orderBy('airplane.airplane_brand_id', 'DESC')->get(['airplane.id', 'airplane.airplane_name', 'airplane_brand.name']);
        $itemEdit = BetweenFlightAirplaneModel::where('flight_id', $id)->join('flight', 'flight.id', '=', 'between_flight_airplane.flight_id')->first(['between_flight_airplane.airplane_id', 'flight.id', 'flight.name', 'flight.location_start', 'flight.location_end', 'flight.time_start', 'flight.type_way', 'flight.information', 'flight.price', 'flight.status', 'flight.image']);
        return view('content.flight.formEdit', compact('itemEdit', 'listAirplane'));
    }
    public function edit(FlightRequest $request)
    {
        $params = [
            "name" => $request->flight_name,
            "location_start" => $request->location_start,
            "location_end" => $request->location_end,
            "time_start" => $request->time_start,
            "information" => $request->information,
            "type_way" => $request->type_way,
            "price" => $request->price,
            "status" => $request->status,
        ];
        $id = $request->id;
        $update = FlightModel::find($id);
        if ($request->hasFile('image')) {
            $resultDL = Storage::delete('/public/' . $update->image);
            $params['image'] = uploadFile('upload', $request->image);
        }

        if ($request->flight_name != $update->name) {
            $check = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->where('flight.name', $request->flight_name)->where('between_flight_airplane.airplane_id', $request->airplane)->first();
            if (!is_null($check)) {
                toastr()->error('Chuyến bay đã tồn tại');
                return redirect()->back();
            }
        }
        $checkBetween = BetweenFlightAirplaneModel::where('flight_id', $id)->first();
        if ($request->airplane != $checkBetween->airplane_id) {
            $check = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->where('flight.name', $request->flight_name)->where('between_flight_airplane.airplane_id', $request->airplane)->first();
            if (!is_null($check)) {
                toastr()->error('Máy bay của hãng hàng không hiện đã tồn tại');
                return redirect()->back();
            }
        }
        $updateBetween = BetweenFlightAirplaneModel::where('flight_id', $id)->update(['airplane_id' => $request->airplane]);


        $update->fill($params);
        $update->save();
        session()->flash('success', 'Sửa thành công');
        return redirect()->route('admin.flight.index');
    }

    public function remove($id)
    {
        $remove = FlightModel::destroy($id);
        session()->flash('success', 'Xóa thành công');
        return redirect()->route('admin.flight.index');
    }
}
