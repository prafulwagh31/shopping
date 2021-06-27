<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use DB;
class RazorpayController extends Controller
{    
    public function create()
    {   
        $paymentdetail = DB::table('payment_gateway')->first();
        return view('payWithRazorpay',['paymentdetail' => $paymentdetail]);
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $paymentdetail = DB::table('payment_gateway')->first();
        $api = new Api($paymentdetail->razorpay_api_key, $paymentdetail->razorpay_secret_key);

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        
        \Session::put('success', 'Payment successful');
        return redirect()->back();
    }
}
