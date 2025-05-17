<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DestinasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'id_kategori' => mt_rand(1, 3),
            'id_kecamatan' => mt_rand(1, 6),
            'slug' => $this->faker->slug(),
            'deskripsi' => $this->faker->paragraph(),
            'harga' => $this->faker->randomFloat(2, 50, 200),
            'gambar' => $this->faker->imageUrl(360, 360, 'cats', true),
            'lokasi' => $this->faker->name(),
            // 'desc' => collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")->implode('')
        ];
    }
}
