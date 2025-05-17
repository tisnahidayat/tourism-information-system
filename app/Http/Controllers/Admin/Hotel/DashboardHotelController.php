<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Hotel',
            'hotel' => Hotel::all()
        ];

        return view('admin.hotels.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotels.create', [
            'title' => 'Tambah',
            'hotel' => Hotel::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama' => 'required|max:30',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'gambar' => 'required'
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar');
        }
        // Simpan data ke dalam database menggunakan model Destinasi
        Hotel::create($validatedData);

        // Redirect ke halaman dashboard wisata dengan pesan sukses
        return redirect()->route('hotel.index')->with('success', 'Hotel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        return view('admin.hotels.show', [
            'hotel' => $hotel,
            'title' => 'Detail'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', [
            'hotel' => $hotel,
            'title' => 'Edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelRequest  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'gambar' => 'image|max:5000',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($hotel->gambar) {
                Storage::delete('public/' . $hotel->gambar);
            }

            $file = $request->file('gambar')->store('gambar');
            $data['gambar'] = str_replace('storage/', '', $file);
        }

        $hotel->update($data);

        return redirect()->route('hotel.index')->with('success', 'Hotel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        Hotel::destroy($hotel->id);

        return redirect('/dashboard/hotel')->with('success', 'Hotel berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Hotel::class, 'slug', $request->nama);
        return Response()->json(['slug' => $slug]);
    }
}
