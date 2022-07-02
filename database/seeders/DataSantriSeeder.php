<?php

namespace Database\Seeders;

use App\Models\DataSantri;
use Illuminate\Database\Seeder;

class DataSantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataSantri::factory(10)->create();
    }
}
