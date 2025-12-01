<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        if (is_null($user->email_verified_at)) {

            $otp = (string) rand(100000, 999999);

            $user->update([
                'otp_code'       => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(5),
            ]);

            Mail::to($user->email)->send(new OTPMail([
                'id'  => $user->id,
                'otp' => $otp,
            ]));

            $request->session()->put('otp_user_id', $user->id);

            return redirect()
                ->route('otp.verify.form')
                ->with('status', 'Kode OTP sudah dikirim ke email Anda.');
        }
        // Jika sudah verified → login normal
        $remember = $request->boolean('remember');
        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
