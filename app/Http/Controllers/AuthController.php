<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'alpha_dash',
                'unique:users,username',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'name' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Registrasi berhasil.');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK EMAIL DI DATABASE TERLEBIH DAHULU
        |--------------------------------------------------------------------------
        */

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'Email belum terdaftar.',
                ])
                ->onlyInput('email');
        }

        /*
        |--------------------------------------------------------------------------
        | GOOGLE-ONLY ACCOUNT
        |--------------------------------------------------------------------------
        */

        if (!$user->password) {
            return back()
                ->withErrors([
                    'email' => 'Akun ini menggunakan login Google.',
                ])
                ->onlyInput('email');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK PASSWORD
        |--------------------------------------------------------------------------
        */

        if (!Hash::check(
            $validated['password'],
            $user->password
        )) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.',
                ])
                ->onlyInput('email');
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->intended(route('dashboard'));
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */

    public function redirectGoogle()
    {
        return Socialite::driver('google')
            ->redirect();
    }


    public function googleCallback(Request $request)
    {
        try {

            $googleUser = Socialite::driver('google')
                ->user();

        } catch (\Exception $e) {

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Login Google gagal.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CEK EMAIL DI DATABASE
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'email',
            $googleUser->getEmail()
        )->first();

        /*
        |--------------------------------------------------------------------------
        | JIKA EMAIL BELUM ADA
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' =>
                        'Email Google belum terdaftar. Silakan register terlebih dahulu.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN GOOGLE ID
        |--------------------------------------------------------------------------
        */

        if (!$user->google_id) {

            $user->update([
                'google_id' => $googleUser->getId(),
            ]);

        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }


    public function sendResetCode(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ]);

        $user = User::where(
            'email',
            $validated['email']
        )->first();

        if (!$user) {

            return back()
                ->withErrors([
                    'email' => 'Email tidak ditemukan.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | GENERATE RANDOM CODE
        |--------------------------------------------------------------------------
        */

        $code = (string) random_int(100000, 999999);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'password_reset_email' => $user->email,
            'password_reset_code' => $code,
            'password_reset_expires' => now()
                ->addMinutes(10)
                ->timestamp,
        ]);

        return redirect()
            ->route('password.reset.form')
            ->with('reset_code', $code);
    }


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD FORM
    |--------------------------------------------------------------------------
    */

    public function showResetPassword()
    {
        if (!session('password_reset_email')) {
            return redirect()
                ->route('password.request');
        }

        return view('auth.reset-password');
    }


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'digits:6',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK CODE
        |--------------------------------------------------------------------------
        */

        if (
            !session('password_reset_code') ||
            $validated['code'] !== session('password_reset_code')
        ) {
            return back()
                ->withErrors([
                    'code' => 'Kode reset password salah.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CEK EXPIRED
        |--------------------------------------------------------------------------
        */

        if (
            !session('password_reset_expires') ||
            now()->timestamp >
            session('password_reset_expires')
        ) {

            session()->forget([
                'password_reset_email',
                'password_reset_code',
                'password_reset_expires',
            ]);

            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'Kode reset sudah kedaluwarsa.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | FIND USER
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'email',
            session('password_reset_email')
        )->first();

        if (!$user) {

            return redirect()
                ->route('password.request')
                ->withErrors([
                    'email' => 'User tidak ditemukan.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */

        $user->update([
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION RESET
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'password_reset_email',
            'password_reset_code',
            'password_reset_expires',
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Password berhasil diubah. Silakan login.'
            );
    }
}
