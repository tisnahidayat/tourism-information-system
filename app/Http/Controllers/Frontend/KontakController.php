<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    public function index()
    {
        return view('frontend.feedback.index', [
            'title' => 'Kontak'
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Anda harus login terlebih dahulu untuk memberikan kritik dan saran.'], 401);
        }

        $request->validate(
            [
                'subject' => 'required|string|max:20',
                'content' => 'required|string'
            ],
            [
                'subject.required' => 'Subjek harus diisi!',
                'content.required' => 'Kirimkan kritik dan saran!'
            ]
        );

        $request->merge(['id_user' => auth()->id()]);
        Feedback::create($request->all());

        return response()->json(['message' => 'Masukan anda berhasil dikirim.'], 200);
    }
}
