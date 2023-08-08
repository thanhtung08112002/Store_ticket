<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AirplaneBrandModel;
use App\Models\FlightModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $airplanebrands = AirplaneBrandModel::all(['id', 'name', 'information']);
        $flightBamboo = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->leftJoin("airplane", "airplane.id", '=', 'between_flight_airplane.airplane_id')->leftJoin("airplane_brand", "airplane_brand.id", '=', 'airplane.airplane_brand_id')->where('flight.status', 1)->where('airplane_brand.name', 'bambooairway')->get(['flight.id', 'flight.name', 'flight.location_start', 'flight.location_end', 'flight.time_start', 'flight.type_way', 'flight.information', 'flight.image', 'flight.price', 'airplane_brand.name as brand']);
        $flightAirline = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->leftJoin("airplane", "airplane.id", '=', 'between_flight_airplane.airplane_id')->leftJoin("airplane_brand", "airplane_brand.id", '=', 'airplane.airplane_brand_id')->where('flight.status', 1)->where('airplane_brand.name', 'vietnamairline')->get(['flight.id', 'flight.name', 'flight.location_start', 'flight.location_end', 'flight.time_start', 'flight.type_way', 'flight.information', 'flight.image', 'flight.price', 'airplane_brand.name as brand']);
        $coupons = DB::table("discount")->where('status',1)->get(['code_sale', 'discount']);
        return view('client.home.index', compact('airplanebrands', 'flightBamboo', 'flightAirline','coupons'));
    }

    public function details(Request $request)
    {
        $id = ($request->id);
        $airBrand = ($request->airBrand);
        if ($airBrand != 'bambooairway') {
            $flightAirline = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->leftJoin("airplane", "airplane.id", '=', 'between_flight_airplane.airplane_id')->leftJoin("airplane_brand", "airplane_brand.id", '=', 'airplane.airplane_brand_id')->where('flight.id', $id)->first(['flight.id', 'flight.name', 'flight.location_start', 'flight.location_end', 'flight.time_start', 'flight.type_way', 'flight.information', 'flight.image', 'flight.price']);
            return response()->json($flightAirline, 200);
        }
        $flightBamboo = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->leftJoin("airplane", "airplane.id", '=', 'between_flight_airplane.airplane_id')->leftJoin("airplane_brand", "airplane_brand.id", '=', 'airplane.airplane_brand_id')->where('flight.id', $id)->first(['flight.id', 'flight.name', 'flight.location_start', 'flight.location_end', 'flight.time_start', 'flight.type_way', 'flight.information', 'flight.image', 'flight.price']);
        return response()->json($flightBamboo, 200);
    }
}
