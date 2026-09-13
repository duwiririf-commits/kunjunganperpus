<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // =========================================
    // HALAMAN UBAH PROFILE
    // =========================================

    public function edit()
    {
        $user = Auth::user();

        return view(
            'pages.profile.edit',
            compact('user')
        );
    }


    // =========================================
    // SIMPAN PERUBAHAN PROFILE
    // =========================================

    public function update(Request $request)
    {
        $user = Auth::user();


        // =========================================
        // VALIDASI
        // =========================================

        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')
                        ->ignore($user->id),
                ],

                'password' => [
                    'nullable',
                    'string',
                    'min:6',
                    'confirmed',
                ],
            ],
            [
                'name.required' =>
                    'Nama wajib diisi.',

                'email.required' =>
                    'Email wajib diisi.',

                'email.email' =>
                    'Format email tidak valid.',

                'email.unique' =>
                    'Email sudah digunakan.',

                'password.min' =>
                    'Password minimal 6 karakter.',

                'password.confirmed' =>
                    'Konfirmasi password tidak sama.',
            ]
        );


        // =========================================
        // UPDATE NAMA DAN EMAIL
        // =========================================

        $user->name =
            $request->name;

        $user->email =
            $request->email;


        // =========================================
        // UPDATE PASSWORD JIKA DIISI
        // =========================================

        if ($request->filled('password')) {

            $user->password =
                Hash::make(
                    $request->password
                );

        }


        // =========================================
        // SIMPAN
        // =========================================

        $user->save();


        return redirect()
            ->route('admin.profile.edit')
            ->with(
                'success',
                'Profile berhasil diperbarui!'
            );
    }
}