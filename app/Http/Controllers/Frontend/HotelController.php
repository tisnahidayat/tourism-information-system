<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hotel;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $dropdown = Hotel::all();
        $selectedHotel = null;

        // Periksa apakah ada nilai yang dipilih pada dropdown select
        if ($request->has('hotel')) {
            if ($request->hotel != '') {
                $selectedHotel = $request->hotel;
                // Simpan nilai dropdown select ke dalam session flash data
                Session::flash('selectedHotel', $selectedHotel);
            } else {
                // Hapus session jika nilai dropdown kosong
                Session::forget('selectedHotel');
            }
        } else {
            $selectedHotel = Session::get('selectedHotel');
        }

        if ($selectedHotel) {
            $hotels = Hotel::where('id', $selectedHotel)->paginate(6)->withQueryString();
        } else {
            $hotels = Hotel::paginate(6);
        }

        return view('frontend.hotel.index', [
            'hotels' => $hotels,
            'dropdown' => $dropdown,
            'title' => 'Hotel',
        ]);
    }

    public function detail(Hotel $hotel)
    {

        $comment = Comment::where('id_hotel', $hotel->id)->with('user')->latest()->get();
        return view('frontend.hotel.detail', [
            'title' => 'Hotel',
            'hotel' => $hotel,
            'komentar' => $comment
        ]);
    }

    public function topkomentar()
    {
        $hotels = Hotel::select(
            'hotels.id',
            'hotels.nama',
            'hotels.slug',
            'hotels.gambar',
            DB::raw('COUNT(comments.id) as total_comments')
        )
            ->leftJoin('comments', 'hotels.id', '=', 'comments.id_hotel')
            ->groupBy('hotels.id', 'hotels.nama', 'hotels.slug', 'hotels.gambar')
            ->orderBy('total_comments', 'desc')
            ->limit(9)
            ->get();

        return view('frontend.hotel.komentar', [
            'hotels' => $hotels,
            'title' => 'Top Komentar Hotel'
        ]);
    }
}
