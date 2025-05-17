<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\Kategori;
use App\Models\Destinasi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WisataController extends Controller
{
    public function wisata(Request $request)
    {
        $kecamatan = Kecamatan::all();
        $kategori = Kategori::all();

        $query = Destinasi::with('kategori');

        $temp = '';

        // Jika ada kategori yang dipilih dari beranda, tambahkan filter berdasarkan kategori
        if ($request->kategori) {
            $kategori = Kategori::where('slug', $request->kategori)->firstOrFail();
            $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('id', $kategori->id);
            });
            $temp = $kategori->nama;
        }

        // Jika ada kecamatan yang dipilih, tambahkan filter berdasarkan kecamatan
        if ($request->kecamatan) {
            $query->where('id_kecamatan', $request->kecamatan);
        }

        // Jika ada destinasi yang dipilih, tambahkan filter berdasarkan destinasi
        if ($request->destinasi != null) {
            $query->where('id', $request->destinasi);
        }

        // Ambil parameter halaman dari query string atau set ke halaman pertama jika tidak ada
        $currentPage = $request->input('page', 1);

        // Jika ada parameter filter, reset halaman ke 1
        if ($request->hasAny(['kategori', 'kecamatan', 'destinasi'])) {
            $currentPage = 1;
        }

        // Paginate dengan mempertahankan parameter halaman yang sesuai
        $destinasi = $query->paginate(6, ['*'], 'page', $currentPage);

        $data = [
            'title' => 'Wisata',
            'temp' => $temp,
            'kategori' => $kategori,
            'destinasi' => $destinasi,
            'kecamatan' => $kecamatan
        ];

        return view('frontend.wisata.index', $data);
    }

    public function detail(Destinasi $wisata)
    {
        // Ambil semua review untuk wisata ini
        $reviews = Review::where('id_wisata', $wisata->id)->with('user')->latest()->get();

        // Menghitung total rating
        $totalRatings = $reviews->count();

        // Menghitung rata-rata rating jika ada rating
        $averageRating = $totalRatings > 0 ? $reviews->avg('rating') : 0;

        return view('frontend.wisata.detail', [
            'title' => 'Detail Wisata',
            'wisata' => $wisata,
            'reviews' => $reviews,
            'totalRatings' => $totalRatings,
            'averageRating' => $averageRating
        ]);
    }


    public function kategori()
    {
        $data = [
            'kategori' => Kategori::all()
        ];

        return view('wisata', $data);
    }

    public function pilihDestinasi($id)
    {
        $destinasi = Destinasi::where('id_kecamatan', $id)->get();

        if ($destinasi->isEmpty()) {
            return response()->json(['message' => 'Tidak ada destinasi untuk kecamatan ini.'], 404);
        }

        return response()->json($destinasi);
    }
}
