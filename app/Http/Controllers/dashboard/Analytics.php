<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {
    $countTicketSuccess = DB::table('order')->where('status', 1)->count(['id']);
    $countTicketCancel = DB::table('order')->where('status', -1)->count(['id']);
    $countTicketPending = DB::table('order')->where('status', 0)->count(['id']);
    return view('content.dashboard.dashboards-analytics',compact('countTicketSuccess', 'countTicketCancel', 'countTicketPending'));
  }
}
