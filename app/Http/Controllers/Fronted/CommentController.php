<?php

namespace App\Http\Controllers\Fronted;

use App\Models\Hotel;
use App\Models\Comment;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function create($id_hotel)
    {
        $hotel = Hotel::findOrFail($id_hotel);
        $existingComment = Comment::where('id_hotel', $id_hotel)
            ->where('id_user', Auth::id())
            ->first();
        return view('frontend.hotel.detail', compact('hotel', 'existingComment'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Anda harus login terlebih dahulu untuk memberikan komentar.'], 401);
        }

        $request->validate([
            'id_hotel' => 'required|exists:hotels,id',
            'komentar' => 'required|string',
        ]);

        try {
            // Buat komentar baru tanpa memeriksa apakah sudah ada komentar sebelumnya
            $komentar = Comment::create([
                'id_hotel' => $request->input('id_hotel'),
                'id_user' => Auth::id(),
                'komentar' => $request->input('komentar')
            ]);

            Session::put('komentar_' . $request->input('id_hotel'), $komentar->komentar);
            return response()->json(['message' => 'Komentar berhasil disimpan.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan komentar. Silakan coba lagi.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            if (Auth::user()->role === 'admin' || $comment->id_user === Auth::id()) {
                $comment->delete();
                Session::forget('komentar_' . $comment->id_hotel);
                return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
            } else {
                return response()->json(['message' => 'Anda tidak memiliki izin untuk menghapus komentar ini.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus komentar. Silakan coba lagi.'], 500);
        }
    }
}
