<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Register',
            'formTitle' => 'Register',
            'formDescription' => 'Silahkan isi form berikut untuk mendaftar',
        ];
        return view('auth.register', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|max:255',
                'password_confirmation' => 'required|same:password',
                'role' => 'required|numeric'
            ],
            [
                'nama' => [
                    'required' => 'Nama harus diisi',
                    'min' => 'Nama minimal 3 karakter',
                    'max' => 'Nama maksimal 255 karakter'
                ],
                'email' => [
                    'required' => 'Email harus diisi',
                    'email' => 'Email tidak valid',
                    'unique' => 'Email sudah terdaftar'
                ],
                'password' => [
                    'required' => 'Password harus diisi',
                    'min' => 'Password minimal 8 karakter',
                    'max' => 'Password maksimal 255 karakter'
                ],
                'password_confirmation' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'same' => 'Konfirmasi password tidak sama dengan password'
                ],
                'role' => [
                    'required' => 'Role harus diisi',
                    'numeric' => 'Role harus berupa angka'
                ]
            ]
        );
        $isGenerateUid = false;
        while (!$isGenerateUid) {
            $uid = Str::random(10);
            $isExist = User::where('uid', $uid)->first();
            if (!$isExist) {
                $validatedData['uid'] = $uid;
                $isGenerateUid = true;
            }
        }
        $validatedData['password'] = bcrypt($validatedData['password']);

        $isRegistered = User::create($validatedData);
        if ($isRegistered) {
            return redirect()->route('login')->with('success', 'Registrasi berhasil, silahkan login');
        }
        return redirect()->back()->with('error', 'Registrasi gagal, silahkan coba lagi');
    }
}
