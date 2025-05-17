<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Carousel;
use App\Models\Kategori;
use App\Models\Navigasi;
use App\Models\Destinasi;
use App\Models\SeniBudaya;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::select(
            'destinasis.id',
            'destinasis.nama',
            'destinasis.slug',
            'destinasis.id_kategori',
            'destinasis.gambar',
            DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating')
        )
            ->leftJoin('reviews', 'destinasis.id', '=', 'reviews.id_wisata')
            ->groupBy('destinasis.id', 'destinasis.nama', 'destinasis.slug', 'destinasis.id_kategori', 'destinasis.gambar')
            ->orderByRaw('COALESCE(AVG(reviews.rating), 0) DESC')
            ->limit(5)
            ->get();

        $data = [
            'title' => 'Beranda',
            'carousels' => Carousel::all(),
            'kategori' => Kategori::all(),
            'feedbacks' => Feedback::all(),
            'wisata' => $destinasi
        ];

        return view('frontend.beranda', $data);
    }

    public function profil()
    {
        $data = [
            'title' => 'Profil'
        ];

        return view('frontend.profil.index', $data);
    }
}
