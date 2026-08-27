<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PengunjungFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nisn_nip' => $this->faker->numerify('########'),
            'nama' => $this->faker->name(),
            'kelas_jabatan' => $this->faker->randomElement([
                'X PPLG 1',
                'X PPLG 2',
                'X PPLG 3',
                'X PM 1',
                'X PM 2',
                'X PM 3',
                'X TF 1',
                'X TF 2',
                'X TO 1',
                'X TO 2',
                'X TO 3',
                'X TO 4',

                'XI RPL 1',
                'XI RPL 2',
                'XI RPL 3',
                'XI LPK 3',
                'XI BD 1',
                'XI BD 2',
                'XI BR',
                'XI TSM 1',
                'XI TSM 2',
                'XI TSM 3',
                'XI TSM 4',

                'XII RPL 1',
                'XII RPL 2',
                'XII RPL 3',
                'XII BD 1',
                'XII BD 2',
                'XII BR',
                'XII TSM 1',
                'XII TSM 2',
                'XII TSM 3',
                'XII TSM 4',
                'XII LPK 3',

                'Guru & Karyawan',
            ]),
        ];
    }
}