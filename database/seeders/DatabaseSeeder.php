<?php

namespace Database\Seeders;

use App\Models\DataSantri;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\DataSantri::factory(20)->create();
        User::create([
            'name' => 'Rizki Darmawan',
            'email' => 'rizkidarmawan.0402102@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        // DataSantri::create([
        //     'nama' => 'Fulan',
        //     'alamat' => 'Semarang',
        //     'no_telp' => '082137135727',
        //     'nama_ortu' => 'Bpk Fulan',
        //     'kampus' => 'Kampus 1',
        //     'gedung' => 'Umar',
        //     'kamar' => '101',
        //     'jenjang' => 'SMP',
        //     'kelas' => '7'
        // ]);
        // DataSantri::create([
        //     'nama' => 'Fulan2',
        //     'alamat' => 'Semarang2',
        //     'no_telp' => '082137135727',
        //     'nama_ortu' => 'Bpk Fulan2',
        //     'kampus' => 'Kampus 2',
        //     'gedung' => 'Umar',
        //     'kamar' => '101',
        //     'jenjang' => 'SMP',
        //     'kelas' => '7'
        // ]);
    }
}
