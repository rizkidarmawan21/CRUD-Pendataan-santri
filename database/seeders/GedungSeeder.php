<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
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
                'gedung' => 'Gedung A',
                'kampus' => 'Kampus 1'
            ],
            [
                'gedung' => 'Gedung B',
                'kampus' => 'Kampus 1'
            ],
            [
                'gedung' => 'Gedung C',
                'kampus' => 'Kampus 1'
            ],
            [
                'gedung' => 'Gedung D',
                'kampus' => 'Kampus 1'
            ],
            [
                'gedung' => 'Gedung E',
                'kampus' => 'Kampus 1'
            ],
            [
                'gedung' => 'Gedung F',
                'kampus' => 'Kampus 2'
            ],
            [
                'gedung' => 'Gedung G',
                'kampus' => 'Kampus 2',
            ],
            [
                'gedung' => 'Gedung H',
                'kampus' => 'Kampus 2'
            ],
            [
                'gedung' => 'Gedung I',
                'kampus' => 'Kampus 2'
            ],
            [
                'gedung' => 'Gedung J',
                'kampus' => 'Kampus 2'
            ],
            [
                'gedung' => 'Gedung K',
                'kampus' => 'Kampus 3'
            ],
            [
                'gedung' => 'Gedung L',
                'kampus' => 'Kampus 3'
            ],
            [
                'gedung' => 'Gedung M',
                'kampus' => 'Kampus 3'
            ],
            [
                'gedung' => 'Gedung N',
                'kampus' => 'Kampus 3'
            ],
            [
                'gedung' => 'Gedung O',
                'kampus' => 'Kampus 3'
            ],

        ];


        try {
            foreach ($data as $key => $value) {
                Gedung::create($value);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
