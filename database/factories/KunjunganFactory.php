<?php

namespace Database\Factories;

use App\Models\Pengunjung;
use Illuminate\Database\Eloquent\Factories\Factory;

class KunjunganFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_pengunjung' => Pengunjung::inRandomOrder()->value('id_pengunjung'),
            'tanggal_kunjungan' => $this->faker->date(),
            'keperluan' => $this->faker->sentence(),
        ];
    }
}