<?php

namespace App\Http\Controllers\Admin\Kuliner;

use App\Models\Kuliner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardKulinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Kuliner',
            'kuliner' => Kuliner::all()
        ];

        return view('admin.kuliner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kuliner.create', [
            'title' => 'Tambah',
            'kuliner' => Kuliner::all()
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
        $validatedData = $request->validate([
            'nama' => 'required|max:30',
            'deskripsi' => 'required',
            'gambar' => 'required'
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar');
        }

        Kuliner::create($validatedData);
        return redirect()->route('kuliner.index')->with('success', 'Kuliner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function show(Kuliner $kuliner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function edit(Kuliner $kuliner)
    {
        return view('admin.kuliner.edit', [
            'kuliner' => $kuliner,
            'title' => 'Edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kuliner $kuliner)
    {
        $request->validate([
            'nama' => 'required|string|max:15',
            'slug' => 'required|string|max:15',
            'deskripsi' => 'required|string',
            'gambar' => 'image|file|max:5000',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($kuliner->gambar) {
                Storage::delete('public/' . $kuliner->gambar);
            }

            $file = $request->file('gambar')->store('gambar');
            $data['gambar'] = str_replace('storage/', '', $file);
        }

        $kuliner->update($data);

        return redirect()->route('kuliner.index')->with('success', 'Kuliner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuliner $kuliner)
    {
        $kuliner->delete();

        return redirect('/dashboard/kuliner')->with('success', 'Kuliner berhasil dihapus!');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kuliner::class, 'slug', $request->nama);
        return Response()->json(['slug' => $slug]);
    }
}
