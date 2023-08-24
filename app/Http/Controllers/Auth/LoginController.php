<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('auth.login', $data);
    }

    public function postLogin(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8|max:255'
            ],
            [
                'email' => [
                    'required' => 'Email harus diisi',
                    'email' => 'Email tidak valid'
                ],
                'password' => [
                    'required' => 'Password harus diisi',
                    'min' => 'Password minimal 8 karakter',
                    'max' => 'Password maksimal 255 karakter'
                ]
            ]
        );

        if (Auth::attempt($validatedData)) {
            return redirect()->route('home')->with('success');
        }
        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('home')->with('success');
    }
}
