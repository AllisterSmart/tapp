<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Recharge;
use Illuminate\Support\Facades\Auth;

class RechargeController extends Controller
{
    public function initiateRecharge(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();

        $razorpayKeyId = 'rzp_test_QPfy4tDzaD5Gnb';
        $razorpayKeySecret = 'M33WG5TjNzcVsdXRYltJQMoi';

        $api = new Api($razorpayKeyId, $razorpayKeySecret);

        $order = $api->order->create([
            'receipt' => 'wallet_recharge_' . $user->id . '_' . time(),
            'amount' => $request->amount * 100, // amount in paise
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);

        Recharge::create([
            'user_id' => $user->id,
            'razorpay_order_id' => $order->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('razorpay.payment', $order->id);
    }
}