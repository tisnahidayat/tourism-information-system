<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SeniBudaya;

class SeniBudayaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Seni dan Budaya',
            'senibudaya' => SeniBudaya::paginate(8)
        ];

        return view('frontend.senibudaya.index', $data);
    }

    public function detail(SeniBudaya $senibudaya)
    {
        return view('frontend.senibudaya.detail', [
            'title' => 'Seni dan Budaya',
            'senibudaya' => $senibudaya
        ]);
    }
}
