<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email WAJIB diisi!',
                'password.required' => 'Kata Sandi WAJIB diisi!'
            ]
        );

        $emailPassword = $request->only('email', 'password');

        if (Auth::attempt($emailPassword)) {
            $user = Auth::user();
            if ($user->level == 'advisor') {
                return redirect()->intended('/admin/faq');
            }
            return redirect()->intended('/login');
        }
        return redirect('login')->with(['error' => 'Nama Pengguna/Password salah!']);
    }
}
