<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Kuliner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KulinerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kuliner',
            'kuliner' => Kuliner::paginate(12)
        ];

        return view('frontend.kuliner.index', $data);
    }

    public function detail(Kuliner $kuliner)
    {
        return view('frontend.kuliner.detail', [
            'title' => 'Kuliner',
            'kuliner' => $kuliner
        ]);
    }
}
