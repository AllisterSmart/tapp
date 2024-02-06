<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'referal_code' => ['nullable', 'exists:users,user_referal_code'],
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'referal_code' => ['nullable', 'exists:users,user_referal_code'],
        ]);

        // Check if the user_referal_code exists
        if ($request->user_referal_code) {
            $existingUser = User::where('referal_code', $request->user_referal_code)->first();

            if (!$existingUser) {
                return redirect()->back()->with('error', 'Invalid referral code. Please enter a valid referral code.');
            }
        }

        // Generate a unique user_id and referral_code
        $user_id = 'U' . '-' . Str::random(8);
        $referral_code = 'EsRt' . '-' . Str::random(8);

        // If user_referal_code exists, store it in the referral_code field
        if ($request->user_referal_code) {
            $referral_code = $request->user_referal_code;
        }

        // Save user with pending status and OTP
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 2;
        $user->mobile = $request->mobile;
        $user->user_id = $user_id;
        $user->user_referal_code = $referral_code;
        $user->referal_code = $request->referal_code;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->otp = rand(100000, 999999); // Generate OTP
        $user->status = 'pending'; // Set initial status as pending
        $user->otp_expires_at = now()->addMinutes(1); // Set OTP expiry to 1 minute from now

        if ($user->save()) {
            // Send OTP via email
            $this->sendOtpEmail($user->email, $user->otp);

            return redirect()->route('verify.otp', ['user' => $user->id]);
        } else {
            return redirect()->back()->with('error', 'Failed to register');
        }
    }

    // Method to send OTP via email
    protected function sendOtpEmail($email, $otp)
    {
        Mail::send('auth.otp', ['otp' => $otp], function ($message) use ($email) {
            $message->to($email)->subject('OTP Verification');
        });
    }

    public function verifyOTP(User $user)
    {
        // Check if OTP is expired
        if ($user->otp_expires_at < now()) {
            // OTP is expired, delete user account
            $user->delete();
            return redirect()->route('register')->with('error', 'OTP expired. Please register again.');
        }

        return view('auth.verify', compact('user'));
    }

    public function processOTP(Request $request, User $user)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Validate OTP
        if ($request->otp != $user->otp) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }

        // Update user status to active and clear OTP
        $user->status = 'active';
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'You are now successfully registered');
    }

    public function resendOTP(User $user)
    {
        // Check if the user has reached the maximum number of OTP resend attempts
        if ($user->otp_resend_attempts >= 3) {
            return redirect()->route('login')->with('error', 'Maximum OTP resend attempts reached. Please register again.');
        }

        // Generate a new OTP
        $newOTP = rand(100000, 999999);

        // Update user with the new OTP and increment resend attempts
        $user->otp = $newOTP;
        $user->otp_resend_attempts++;
        $user->otp_expires_at = now()->addMinutes(1); // Set OTP expiry to 1 minute from now
        $user->save();

        // Send the new OTP via email
        $this->sendOtpEmail($user->email, $newOTP);

        return redirect()->route('verify.otp', ['user' => $user->id])->with('success', 'OTP resent successfully.');
    }

    // Automatically delete user account if OTP is not entered within one minute
    public function deleteUnverifiedUser(User $user)
    {
        // Check if OTP is expired
        if ($user->otp_expires_at < now()) {
            // OTP is expired, delete user account
            $user->delete();
            return redirect()->route('register')->with('error', 'User account deleted. OTP expired. Please register again.');
        }

        return redirect()->route('register')->with('error', 'User account not deleted. OTP not expired yet.');
    }
}
