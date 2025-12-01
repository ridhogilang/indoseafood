<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class OTPController extends Controller
{
    protected function maskEmail(string $email): string
    {
        // pecah email jadi username + domain
        [$username, $domain] = explode('@', $email);

        $len = strlen($username);

        // Kalau panjang username <= 3
        if ($len <= 3) {
            return str_repeat('*', max($len - 1, 0)) . substr($username, -1) . '@' . $domain;
        }

        // Ambil 3 huruf terakhir username
        $lastThree = substr($username, -3);

        // Sisanya diganti *
        $stars = str_repeat('*', $len - 3);

        return $stars . $lastThree . '@' . $domain;
    }


    public function index(Request $request)
    {
        $userId = $request->session()->get('otp_user_id');

        $remainingSeconds = 0;
        $maskedEmail = null;

        if ($userId) {
            $user = User::find($userId);

            if ($user && $user->otp_expires_at) {
                $now       = Carbon::now();
                $expiresAt = Carbon::parse($user->otp_expires_at);

                if ($expiresAt->greaterThan($now)) {
                    // pastikan integer
                    $remainingSeconds = (int) $now->diffInSeconds($expiresAt);
                } else {
                    $remainingSeconds = 0;
                }
            }

            if ($user) {
                $maskedEmail = $this->maskEmail($user->email);
            }
        }

        return view('auth.otp', [
            'title'            => 'Verifikasi Email',
            'remainingSeconds' => $remainingSeconds,
            'maskedEmail'      => $maskedEmail,
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'first'  => ['required', 'string', 'size:1'],
            'second' => ['required', 'string', 'size:1'],
            'third'  => ['required', 'string', 'size:1'],
            'fourth' => ['required', 'string', 'size:1'],
            'fifth'  => ['required', 'string', 'size:1'],
            'sixth'  => ['required', 'string', 'size:1'],
        ]);

        // 2. Gabungkan jadi satu kode OTP
        $otp = $request->first
            . $request->second
            . $request->third
            . $request->fourth
            . $request->fifth
            . $request->sixth;

        if (!preg_match('/^\d{6}$/', $otp)) {
            return back()->withErrors(['otp' => 'Kode OTP harus berupa 6 digit angka.']);
        }

        // 3. Ambil user dari session
        $userId = $request->session()->get('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')
                ->withErrors(['otp' => 'Sesi OTP tidak valid.']);
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['otp' => 'User tidak ditemukan.']);
        }

        // 4. Cek kode OTP
        if ($user->otp_code !== $otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // 5. Cek expired (jaga-jaga kalau kolom null)
        if (!$user->otp_expires_at || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan minta baru.']);
        }

        // 6. OTP valid → verifikasi email & bersihkan kolom OTP
        $user->update([
            'email_verified_at' => Carbon::now(),
            'otp_code'          => null,
            'otp_expires_at'    => null,
        ]);

        // 7. Login user & redirect
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }


    public function resend(Request $request)
    {
        // ambil user id dari session
        $userId = $request->session()->get('otp_user_id');

        if (! $userId) {
            return redirect()
                ->route('login')
                ->withErrors(['otp' => 'Your OTP session has expired. Please login again.']);
        }

        $user = User::find($userId);

        if (! $user) {
            return redirect()
                ->route('login')
                ->withErrors(['otp' => 'User not found. Please login again.']);
        }

        // CEK: kalau OTP lama masih berlaku, jangan izinkan resend (anti curang)
        if ($user->otp_expires_at && Carbon::now()->lt($user->otp_expires_at)) {
            return redirect()
                ->route('otp.verify.form')
                ->withErrors(['otp' => 'Please wait until the timer finishes before requesting a new code.']);
        }

        // Generate OTP baru
        $otp = (string) rand(100000, 999999);

        // Simpan ke database dengan expired 5 menit dari sekarang
        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Kirim email OTP baru
        Mail::to($user->email)->send(new OTPMail([
            'id'  => $user->id,
            'otp' => $otp,
        ]));

        // Pastikan otp_user_id tetap di session
        $request->session()->put('otp_user_id', $user->id);

        return redirect()
            ->route('otp.verify.form')
            ->with('status', 'A new OTP code has been sent to your email.');
    }
}
