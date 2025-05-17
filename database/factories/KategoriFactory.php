<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
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
            'slug' => $this->faker->slug(),
            'gambar' => $this->faker->imageUrl(360, 360, 'cats', true)
        ];
    }
}
