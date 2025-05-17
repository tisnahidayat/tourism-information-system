<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardPenggunaControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Pengguna',
            'pengguna' => User::all()
        ];

        return view('admin.pengguna.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengguna.create', [
            'title' => 'Tambah',
            'pengguna' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:50',
            'role' => 'required|max:10',
            'email' => 'required|unique:users|email:dns',
            'password' => 'required|min:7',
        ], [
            'username.required' => 'Username harus diisi!',
            'role.required' => 'Role harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email ini sudah digunakan!',
            'password.required' => 'Password harus diisi!',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pengguna)
    {
        return view('admin.pengguna.edit', [
            'pengguna' => $pengguna,
            'title' => 'Edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pengguna)
    {
        $validated = $request->validate([
            'username' => 'required|max:50',
            'role' => 'required|max:10',
            'email' => [
                'required',
                'email:dns',
                Rule::unique('users')->ignore($pengguna->id)
            ],
            'password' => 'sometimes|required|min:7'
        ], [
            'username.required' => 'Username harus diisi!',
            'role.required' => 'Role harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email ini sudah digunakan!',
            'password.min' => 'Password harus minimal 7 karakter!'
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pengguna->update($validated);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return redirect('/dashboard/pengguna')->with('success', 'Pengguna berhasil dihapus!');
    }
}
