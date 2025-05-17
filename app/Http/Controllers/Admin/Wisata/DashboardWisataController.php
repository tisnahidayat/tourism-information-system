<?php

namespace App\Http\Controllers\Admin\Wisata;

use App\Models\Kategori;
use App\Models\Destinasi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Wisata',
            'wisata' => Destinasi::all()
        ];

        return view('admin.wisata.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wisata.create', [
            'title' => 'Tambah',
            'kategori' => Kategori::all(),
            'kecamatan' => Kecamatan::all()
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
            'nama' => 'required|max:30',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'image|file|max:5000'
        ]);

        // Menambahkan kategori dan kecamatan ke dalam array $validatedData
        $validatedData['id_kategori'] = $request->kategori;
        $validatedData['id_kecamatan'] = $request->kecamatan;

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar');
        }

        // Simpan data ke dalam database menggunakan model Destinasi
        Destinasi::create($validatedData);

        // Redirect ke halaman dashboard wisata dengan pesan sukses
        return redirect()->route('wisata.index')->with('success', 'Wisata berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destinasi
     * @return \Illuminate\Http\Response
     */
    public function show(Destinasi $wisatum)
    {
        $data = [
            'title' => 'Detail Wisata',
            'destinasi' => $wisatum
        ];
        return view('admin.wisata.show', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Destinasi $wisatum)
    {
        return view('admin.wisata.edit', [
            'destinasi' => $wisatum,
            'title' => 'Edit',
            'kategori' => Kategori::all(),
            'kecamatan' => Kecamatan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destinasi $wisatum)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'kategori' => 'required|exists:kategoris,id',
            'kecamatan' => 'required|exists:kecamatans,id',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:5000',
        ]);

        $validatedData['id_kategori'] = $request->kategori;
        $validatedData['id_kecamatan'] = $request->kecamatan;

        if ($request->hasFile('gambar')) {
            if ($wisatum->gambar) {
                Storage::delete($wisatum->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('gambar');
        } else {
            $validatedData['gambar'] = $wisatum->gambar;
        }

        $wisatum->update($validatedData);

        return redirect()->route('wisata.index')->with('success', 'Wisata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinasi $wisatum)
    {
        Destinasi::destroy($wisatum->id);

        return redirect('/dashboard/wisata')->with('success', 'Wisata baru berhasil');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Destinasi::class, 'slug', $request->nama);
        return Response()->json(['slug' => $slug]);
    }
}
