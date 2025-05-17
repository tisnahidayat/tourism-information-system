<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('authentication.register', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:30',
            'email' => 'required|unique:users|email:dns',
            'password' => 'required|min:7',
            'repassword' => 'required|same:password',
        ], [
            'username.required' => 'Nama depan harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email ini sudah digunakan!',
            'password.required' => 'Password harus diisi!',
            'repassword.required' => 'Repassword harus diisi!',
            'repassword.same' => 'Repassword harus sama dengan Password!'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';
        User::create($validated);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }
}
