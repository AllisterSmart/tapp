<?php

namespace App\Http\Controllers\Web;

use App\Models\Recharge; // Import the Recharge model
use App\Models\User;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Http\Controllers\Controller;
use Auth;

class RazorpayController extends Controller
{
   public function addWallet()
{
    // Check if the user is logged in
    if (auth()->check()) {
        // If logged in, fetch the wallet balance
        $balance = Recharge::where('user_id', auth()->user()->id)->sum('amount');
        return view('web.wallet.payment', compact('balance'));
    }

    // If not logged in, you can redirect to the login page or handle it as needed
    return redirect()->route('login');
}

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

    public function handlePayment($orderId)
    {
        $razorpayKeyId = 'rzp_test_QPfy4tDzaD5Gnb';
        $razorpayKeySecret = 'M33WG5TjNzcVsdXRYltJQMoi';

        // Create Razorpay API instance
        $order = (new Api($razorpayKeyId, $razorpayKeySecret))->order->fetch($orderId);

        return view('web.wallet.success', compact('order'));
    }

    public function confirmPayment(Request $request)
    {
        $razorpayKeyId = 'rzp_test_QPfy4tDzaD5Gnb';
        $razorpayKeySecret = 'M33WG5TjNzcVsdXRYltJQMoi';

        $order = (new Api($razorpayKeyId, $razorpayKeySecret))
            ->order->fetch($request->razorpay_order_id);

        if ($order->status === 'paid') {
            $recharge = Recharge::where('razorpay_order_id', $order->id)->first();
            $recharge->status = 'success';
            $recharge->save();

            // Update user's wallet balance
            $user = Auth::user();
            $user->addBalance($recharge->amount);

            return redirect()->route('addwallet')->with('success', 'Wallet recharged successfully.');
        }

        return redirect()->route('addwallet')->with('error', 'Payment failed. Please try again.');
    }
}
