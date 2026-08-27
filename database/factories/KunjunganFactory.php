<?php

namespace Database\Factories;

use App\Models\Pengunjung;
use Illuminate\Database\Eloquent\Factories\Factory;

class KunjunganFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pengunjung_id' => Pengunjung::factory(),

            'tanggal_kunjungan' => fake()->date(),

            'keperluan' => fake()->sentence(),
        ];
    }
}