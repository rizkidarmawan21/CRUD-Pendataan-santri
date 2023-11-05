<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                //  make kamar with random format ex: 101
                'kamar' => rand(100, 999),
                // random 1-14
                'id_gedung' => rand(1, 14)
            ]
        ];

        // looping 15x
        for ($i = 0; $i < 15; $i++) {
            // make kamar with random format ex: 101
            Kamar::create([
                'kamar' => rand(100, 999),
                // random 1-14
                'id_gedung' => rand(1, 14)
            ]);
        }
    }
}
