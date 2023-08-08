<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function pending(){
        $listOrder = DB::table('order')
        ->join('customer', 'customer.id', '=', 'order.customer_id')
        ->join('flight', 'flight.id', '=', 'order.flight_id')
        ->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')
        ->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')
        ->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')
        ->orderBy('order.created_at', 'desc')
        ->where('order.status',0)
        ->paginate(10, ['order.id', 'order.code_order','order.type_payment', 'order.quantity', 'order.type_seat', 'order.order_total', 'order.order_total_discount', 'order.status', 'order.created_at', 'order.updated_at', 'customer.fullname', 'customer.gender', 'customer.birthday', 'customer.passport_cccd', 'customer.phone', 'customer.address', 'customer.email', 'airplane_brand.name as airplane_brand_name', 'airplane.airplane_name', 'flight.time_start', 'flight.location_start', 'flight.location_end', 'flight.information', 'flight.image', 'flight.type_way', 'flight.name as flight_name']);
    return view('content.ticket.pending', compact('listOrder'));
    }
    public function success(){
        $listOrder = DB::table('order')
        ->join('customer', 'customer.id', '=', 'order.customer_id')
        ->join('flight', 'flight.id', '=', 'order.flight_id')
        ->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')
        ->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')
        ->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')
        ->orderBy('order.created_at', 'desc')
        ->where('order.status',1)
        ->paginate(10, ['order.id', 'order.code_order','order.type_payment', 'order.quantity', 'order.type_seat', 'order.order_total', 'order.order_total_discount', 'order.status', 'order.created_at', 'order.updated_at', 'customer.fullname', 'customer.gender', 'customer.birthday', 'customer.passport_cccd', 'customer.phone', 'customer.address', 'customer.email', 'airplane_brand.name as airplane_brand_name', 'airplane.airplane_name', 'flight.time_start', 'flight.location_start', 'flight.location_end', 'flight.information', 'flight.image', 'flight.type_way', 'flight.name as flight_name']);
    return view('content.ticket.pending', compact('listOrder'));
    }
    public function cancel(){
        $listOrder = DB::table('order')
        ->join('customer', 'customer.id', '=', 'order.customer_id')
        ->join('flight', 'flight.id', '=', 'order.flight_id')
        ->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')
        ->join('airplane', 'airplane.id', '=', 'between_flight_airplane.airplane_id')
        ->join('airplane_brand', 'airplane_brand.id', '=', 'airplane.airplane_brand_id')
        ->orderBy('order.created_at', 'desc')
        ->where('order.status',-1)
        ->paginate(10, ['order.id', 'order.code_order','order.type_payment', 'order.quantity', 'order.type_seat', 'order.order_total', 'order.order_total_discount', 'order.status', 'order.created_at', 'order.updated_at', 'customer.fullname', 'customer.gender', 'customer.birthday', 'customer.passport_cccd', 'customer.phone', 'customer.address', 'customer.email', 'airplane_brand.name as airplane_brand_name', 'airplane.airplane_name', 'flight.time_start', 'flight.location_start', 'flight.location_end', 'flight.information', 'flight.image', 'flight.type_way', 'flight.name as flight_name']);
    return view('content.ticket.pending', compact('listOrder'));
    }
}
