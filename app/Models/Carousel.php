<?php

namespace App\Models;


class Carousel
{
    private static $carousel_image = [
        [
            'gambar' => "carousel1.jpg",
            'judul' => "Nikmati senja di Pantai Utara Karawang",
            'deskripsi' => "Rasakan keindahan senja yang memukau di tepi pantai utara Karawang, dengan deburan ombak yang menenangkan dan langit senja yang memerah. Pantai ini menawarkan pemandangan spektakuler yang cocok untuk bersantai, menikmati keindahan alam, dan melupakan sejenak hiruk-pikuk keseharian"
        ],
        [
            'gambar' => "carousel2.jpg",
            'judul' => "Pesona Pesawahan Karawang",
            'deskripsi' => "Lihatlah panorama hijau yang menakjubkan dari pesawahan Karawang, di mana hamparan sawah yang subur menghijau sejauh mata memandang. Suasana yang tenang dan udara segar menjadikan pesawahan ini sebagai tempat ideal untuk melarikan diri dari kebisingan perkotaan dan menikmati keindahan alam yang alami"
        ],
        [
            'gambar' => "carousel3.jpg", //gambar puncak pinus 
            'judul' => "Puncak Pinus yang Menawan",
            'deskripsi' => "Jelajahi keindahan alam di puncak pinus yang mempesona, di mana pepohonan pinus yang tinggi menjulang dan udara yang sejuk menghembuskan angin sepoi-sepoi. Suasana puncak pinus ini menawarkan tempat yang sempurna untuk berpiknik, hiking, atau sekadar menikmati panorama alam yang menenangkan"
        ]
    ];

    public static function all()
    {
        return self::$carousel_image;
    }
}
