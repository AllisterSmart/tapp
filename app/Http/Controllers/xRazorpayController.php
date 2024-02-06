<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;

class RazorpayController extends Controller {

    public function addwallet()
    {        
        return view('web.payment');
    }

    public function payment()
    {
        //Input form item
        $input = Input::all();
        //get razor_key_id and razor_key_secret
        $api = new Api(config('custom.razor_key'), config('custom.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try {
                $response = $api->payment
                                ->fetch($input['razorpay_payment_id'])
                                ->capture(array('amount'=>$payment['amount']));

                $id = $response->id;
                $card_id = $response->card_id;
                $status = $response->status;
                $amount = $response->amount;
                $description = $response->description;
                
                //-------------------------------------------------------------
                // Do something here for store payment details in database...
                //-------------------------------------------------------------

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