<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMailCancel;
use App\Mail\SendTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $listOrder = DB::table('order')
            ->join('customer', 'customer.id', '=', 'order.customer_id')
            ->join('flight', 'flight.id', '=', 'order.flight_id')
            ->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')
            ->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')
            ->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')
            ->orderBy('order.created_at', 'desc')
            ->paginate(10, ['order.id', 'order.code_order','order.type_payment', 'order.quantity', 'order.type_seat', 'order.order_total', 'order.order_total_discount', 'order.status', 'order.created_at', 'order.updated_at', 'customer.fullname', 'customer.gender', 'customer.birthday', 'customer.passport_cccd', 'customer.phone', 'customer.address', 'customer.email', 'airplane_brand.name as airplane_brand_name', 'airplane.airplane_name', 'flight.time_start', 'flight.location_start', 'flight.location_end', 'flight.information', 'flight.image', 'flight.type_way', 'flight.name as flight_name']);
        return view('content.order.index', compact('listOrder'));
    }
    public function details($id)
    {
        $detailOrder = DB::table('order')
            ->join('customer', 'customer.id', '=', 'order.customer_id')
            ->join('flight', 'flight.id', '=', 'order.flight_id')
            ->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')
            ->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')
            ->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')
            ->where('order.id', $id)
            ->first(['order.id', 'order.code_order', 'order.quantity', 'order.type_seat', 'order.order_total', 'order.order_total_discount', 'order.status', 'order.created_at', 'order.updated_at', 'customer.fullname', 'customer.gender', 'customer.birthday', 'customer.passport_cccd', 'customer.phone', 'customer.address', 'customer.email', 'airplane_brand.name as airplane_brand_name', 'airplane.airplane_name', 'flight.time_start', 'flight.location_start', 'flight.location_end', 'flight.information', 'flight.image', 'flight.type_way', 'flight.name as flight_name']);
        return view("content.order.details", compact('detailOrder'));
    }

    public function update(Request $request)
    {
        $params = [
            'status' => 1
        ];
        $changeStatusOrder = DB::table('order')->where('id', $request->id)->update($params);
        if ($changeStatusOrder) {
                $data  = DB::table('order')
                ->join('customer', 'customer.id', '=', 'order.customer_id')
                ->join('flight', 'flight.id', '=', 'order.flight_id')
                ->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')
                ->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')
                ->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')
                ->where('order.id', $request->id)
                ->first(['order.id', 'order.code_order', 'order.quantity', 'order.type_seat', 'order.order_total', 'order.order_total_discount', 'order.status', 'order.created_at', 'order.updated_at', 'customer.fullname', 'customer.gender', 'customer.birthday', 'customer.passport_cccd', 'customer.phone', 'customer.address', 'customer.email', 'airplane_brand.name as airplane_brand_name', 'airplane.airplane_name', 'flight.time_start', 'flight.location_start', 'flight.location_end', 'flight.information', 'flight.image', 'flight.type_way', 'flight.name as flight_name']);
                sendMail($request->email,new SendTicket($data));
                return true;
        }
    }

    public function cancel(Request $request) {
        $params = [
            'status' => -1
        ];
        $changeStatusOrder = DB::table('order')->where('id', $request->id)->update($params);
        if ($changeStatusOrder) {
                $data  = DB::table('order')
                ->join('customer', 'customer.id', '=', 'order.customer_id')
                ->join('flight', 'flight.id', '=', 'order.flight_id')
                ->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')
                ->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')
                ->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')
                ->where('order.id', $request->id)
                ->first(['order.id', 'order.code_order', 'order.quantity', 'order.type_seat', 'order.order_total', 'order.order_total_discount', 'order.status', 'order.created_at', 'order.updated_at', 'customer.fullname', 'customer.gender', 'customer.birthday', 'customer.passport_cccd', 'customer.phone', 'customer.address', 'customer.email', 'airplane_brand.name as airplane_brand_name', 'airplane.airplane_name', 'flight.time_start', 'flight.location_start', 'flight.location_end', 'flight.information', 'flight.image', 'flight.type_way', 'flight.name as flight_name']);
                sendMail($request->email,new SendMailCancel($data));
                return true;
        }
    }
}
