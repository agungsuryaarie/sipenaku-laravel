<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == 1) {
                return redirect()->intended('dashboard.index');
            } elseif ($user->level == 2) {
                return redirect()->intended('dashboard.index');
            }
        }
        // dd($user);
        return view('auth.login');
    }
    public function verifikasi(Request $request)
    {
        //validate form
        $kredensial =  $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username tidak boleh kosong.',
                'password.required' => 'Password tidak boleh kosong.',
            ]
        );

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == 1) {
                return redirect()->intended('dashboard.index');
            } elseif ($user->level == 2) {
                return redirect()->intended('dashboard.index');
            }
            return redirect()->intended('dashboard.index');
        }
        return back()->withErrors(['username' => 'Maaf username dan password salah!'])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
