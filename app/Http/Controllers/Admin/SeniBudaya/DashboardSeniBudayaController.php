<?php

namespace App\Http\Controllers\Admin\SeniBudaya;

use App\Models\SeniBudaya;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardSeniBudayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Seni dan Budaya',
            'senibudaya' => SeniBudaya::all()
        ];

        return view('admin.senibudaya.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.senibudaya.create', [
            'title' => 'Tambah',
            'senibudaya' => SeniBudaya::all()
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
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama' => 'required|max:15',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|file|max:5000'
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar');
        }

        // Simpan data ke dalam database menggunakan model Destinasi
        SeniBudaya::create($validatedData);

        // dd($validatedData);
        // Redirect ke halaman dashboard wisata dengan pesan sukses
        return redirect()->route('senibudaya.index')->with('success', 'Kesenian/Kebudayaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeniBudaya  $seniBudaya
     * @return \Illuminate\Http\Response
     */
    public function show(SeniBudaya $senibudaya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeniBudaya  $seniBudaya
     * @return \Illuminate\Http\Response
     */
    public function edit(SeniBudaya $senibudaya)
    {
        return view('admin.senibudaya.edit', [
            'senibudaya' => $senibudaya,
            'title' => 'Edit'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeniBudaya  $seniBudaya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeniBudaya $senibudaya)
    {
        $request->validate([
            'nama' => 'required|string|max:20',
            'slug' => 'required|string|max:20',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'gambar' => 'file|image',
        ]);


        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($request->$senibudaya) {
                Storage::delete('public/' . $senibudaya->gambar);
            }

            $file = $request->file('gambar')->store('gambar');
            $data['gambar'] = str_replace('storage/', '', $file);
        }

        $senibudaya->update($data);

        return redirect()->route('senibudaya.index')->with('success', 'Kesenian/Kebudayaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeniBudaya  $seniBudaya
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeniBudaya $senibudaya)
    {
        $senibudaya->delete();

        return redirect('/dashboard/senibudaya')->with('success', 'Kesenian/Kebudayaan berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(SeniBudaya::class, 'slug', $request->nama);
        return Response()->json(['slug' => $slug]);
    }
}
