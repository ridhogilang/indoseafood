<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot', [
            "title" => "Reset Password",
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => ['required', 'email'],
            ],
            [
                'email.required' => 'Please enter your email address.',
                'email.email'    => 'Please enter a valid email address.',
            ]
        );

        $user = User::where('email', $validated['email'])->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Please enter a valid email address.',
            ]);
        }

        $status = Password::sendResetLink([
            'email' => $validated['email'],
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Password reset link has been sent to your email.')
            : back()->withErrors([
                'email' => 'Unable to send password reset link. Please try again later.',
            ]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        $title = "Reset Password";
        return view('auth.reset')->with(
            [
                'token' => $token,
                'email' => $request->email,
                'title' => $title
            ]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Your password has been reset successfully.')
            : back()->withErrors(['email' => __($status)]);
    }
}
