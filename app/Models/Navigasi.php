<?php

namespace App\Models;


class Navigasi
{
    private static $navigasi = [
        [
            'gambar' => "mountain.jpg",
            'judul' => "Destinasi Pilihan"
        ],
        [
            'gambar' => "view.jpg",
            'judul' => "Seni dan Budaya"
        ],
        [
            'gambar' => "view3.jpg",
            'judul' => "Kuliner"
        ],
        [
            'gambar' => "view3.jpg",
            'judul' => "Blog Wisata"
        ]
    ];

    public static function all()
    {
        return self::$navigasi;
    }
}
