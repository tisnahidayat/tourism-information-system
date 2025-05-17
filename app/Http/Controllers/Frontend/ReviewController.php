<?php

namespace App\Http\Controllers\frontend;

use App\Models\Destinasi;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function create($id_wisata)
    {
        $wisata = Destinasi::findOrFail($id_wisata);
        $reviews = Review::where('id_wisata', $id_wisata)->get();

        $totalRatings = $reviews->count();

        $averageRating = $totalRatings > 0 ? $reviews->avg('rating') : 0;

        $existingReview = Review::where('id_wisata', $id_wisata)
            ->where('id_user', Auth::id())
            ->first();

        return view('frontend.wisata.detail', compact('wisata', 'existingReview', 'totalRatings', 'averageRating'));
    }


    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Anda harus login terlebih dahulu untuk memberikan ulasan.'], 401);
        }
        $request->validate([
            'id_wisata' => 'required|exists:destinasis,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        try {
            $review = Review::updateOrCreate(
                [
                    'id_wisata' => $request->input('id_wisata'),
                    'id_user' => Auth::id(),
                ],
                [
                    'rating' => $request->input('rating'),
                    'review' => $request->input('review'),
                ]
            );
            Session::put('rating_' . $request->input('id_wisata'), $review->rating);
            Session::put('review_' . $request->input('id_wisata'), $review->review);
            return response()->json(['message' => 'Review berhasil disimpan.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan review. Silakan coba lagi.'], 500);
        }
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        if (Auth::user()->role === 'admin') {
            try {
                $review->delete();
                Session::forget('rating_' . $review->id_wisata);
                Session::forget('review_' . $review->id_wisata);

                return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal menghapus ulasan. Silakan coba lagi.');
            }
        } else {
            if ($review->id_user !== Auth::id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus ulasan ini.');
            }
            try {
                $review->delete();
                Session::forget('rating_' . $review->id_wisata);
                Session::forget('review_' . $review->id_wisata);
                return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal menghapus ulasan. Silakan coba lagi.');
            }
        }
    }
}
