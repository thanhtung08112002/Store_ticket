<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\SendMail;
use App\Models\FlightModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $flight = DB::table('flight')->join('between_flight_airplane', 'between_flight_airplane.flight_id', '=', 'flight.id')->leftJoin("airplane", "airplane.id", '=', 'between_flight_airplane.airplane_id')->where('flight.id', $id)->first(['flight.id', 'flight.name', 'flight.location_start', 'flight.location_end', 'flight.time_start', 'flight.type_way', 'flight.information', 'flight.image', 'flight.price', 'airplane.qty_seat']);
        return view('client.checkout.checkout', compact('flight'));
    }

    public function pay(CheckoutRequest $request)
    {
        $orderCode = Carbon::now()->format('YmdHis');
        $params = [
            $request->fullname,
            $request->gender,
            $request->birthday,
            $request->passport,
            $request->address,
            $request->phone,
            $request->email,
            $orderCode,
            $request->id,
            $request->qty_person,
            $request->orderTotal,
            $request->orderTotalDiscount,
            Carbon::now(),
            Carbon::now(),
            
        ];

        if ($request->vnpay == 1) {
            $paramsVnPay = [
                'orderCode' => $orderCode,
                "orderTotal" => $request->orderTotal,
                "orderTotalDiscount" => $request->orderTotalDiscount,
                "fullname" =>  $request->fullname,
                "passport" => $request->passport,
                "address" => $request->address,
                "phone" => $request->phone,
                "email" => $request->email,
                "redirect" => $request->vnpay
            ];
            DB::select('CALL addOrder(?,?,?,?,?,?,?,?,?,?,?,?,?,?,"vnpay")', $params);
            return ($this->vnpay($paramsVnPay, $params));
        }
        DB::select('CALL addOrder(?,?,?,?,?,?,?,?,?,?,?,?,?,?,"Thông thường")', $params);
        Mail::to($request->email)->queue(new SendMail());
        toastr()->success('Thông báo', "Đặt vé thành công");
        return redirect()->route("client.");
    }
    public function checkDiscount($code)
    {
        $check = DB::table('discount')->where('code_sale', $code)->where('status', 1)->first(['discount']);
        if (!$check) {
            return response()->json(
                ['message' => "Mã không tồn tại hoặc chưa được áp dụng"],
                404
            );
        }
        return response()->json(
            $check,
            200
        );
    }

    public function vnpay($data,$params)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route("ajax.paymentVNPay");
        $vnp_TmnCode = "0NVX0OAF"; //Mã website tại VNPAY 
        $vnp_HashSecret = "DBPYGVYKUPZOALBMBDOFRSFRUVKYDCHD"; //Chuỗi bí mật

        $vnp_TxnRef = $data['orderCode']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán vé máy bay";
        $vnp_OrderType = "01";
        $vnp_Amount = $data['orderTotalDiscount'] == 0 ? $data['orderTotal'] * 100 : $data['orderTotalDiscount'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $_POST['bank_code'] ?? "NCB";
        $host = $_SERVER['REMOTE_ADDR'] . ":8000";
        $vnp_IpAddr = $host;
        //Add Params of 2.0.1 Version
        $vnp_ExpireDate = $_POST['txtexpire'] ?? "";
        //Billing
        $vnp_Bill_Mobile = $_POST['txt_billing_mobile'] ?? "";
        $vnp_Bill_Email = $_POST['txt_billing_email'] ?? "";
        $fullName = trim($data['fullname']);
        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $vnp_Bill_Address = $_POST['txt_inv_addr1'] ?? "";
        $vnp_Bill_City = $data['address'];
        $vnp_Bill_Country = $_POST['txt_bill_country'] ?? "";
        $vnp_Bill_State = $_POST['txt_bill_state'] ?? "";
        // Invoice
        $vnp_Inv_Phone = $data['phone'];
        $vnp_Inv_Email =  $data['email'];
        $vnp_Inv_Customer = $_POST['txt_inv_customer'] ?? "";
        $vnp_Inv_Address = $_POST['txt_inv_addr1'] ?? "";
        $vnp_Inv_Company = $data['address'];
        $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'] ?? "";
        $vnp_Inv_Type = $_POST['cbo_inv_type'] ?? "";
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => json_encode($params),
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($data['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
    public function paymentVNPay(Request $request)
    {
            $email = DB::table('order')->join('customer','customer.id','=','order.customer_id')->orderBy('order.created_at','desc')->first(['customer.email']);
            Mail::to($email)->queue(new SendMail());
            toastr()->success('Thông báo', "Đặt vé thành công");
            return redirect()->route("client.");
    }
}
