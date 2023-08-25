<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profil Saya',
        ];
        return view('home.profile.index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Profil',
        ];
        return view('home.profile.edit', $data);
    }

    public function update(Request $request)
    {
        $userId = Auth::user()->id;
        $validatedData = $request->validate(
            [
                'nama' => 'required|min:3|max:255',
                'email' => 'required|unique:users,email,' . $userId . '|min:3|max:255',
                'bio' => 'nullable|min:8|max:255',
                'foto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'nama' => [
                    'required' => 'Nama harus diisi',
                    'min' => 'Nama minimal 3 karakter',
                    'max' => 'Nama maksimal 255 karakter',
                ],
                'email' => [
                    'required' => 'Email harus diisi',
                    'unique' => 'Email sudah ada',
                    'min' => 'Email minimal 3 karakter',
                    'max' => 'Email maksimal 255 karakter',
                ],
                'bio' => [
                    'min' => 'Bio minimal 8 karakter',
                    'max' => 'Bio maksimal 255 karakter',
                ],
                'foto' => [
                    'image' => 'Foto harus berupa gambar',
                    'mimes' => 'Foto harus berupa gambar',
                    'max' => 'Foto maksimal 2048 KB',
                ],
            ]
        );

        if ($request->hasFile('foto')) {
            $fotoName = Auth::user()->foto;
            if ($fotoName) {
                Storage::disk('public')->delete($fotoName);
            }
            $validatedData['foto'] = $request->file('foto')->store('Foto-Profil', 'public');
        }

        $isUpdated = User::find($userId)->update($validatedData);
        if ($isUpdated) {
            return redirect()->route('profile')->with('success', 'Profil telah diedit');
        }
        return redirect()->route('profile')->with('error', 'Profil gagal diedit');
    }
}
