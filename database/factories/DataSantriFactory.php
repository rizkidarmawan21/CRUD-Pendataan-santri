<?php

namespace Database\Factories;

use App\Models\DataSantri;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataSantriFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DataSantri::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'no_telp' => '08' . mt_rand(100000000, 999999999),
            'nama_ortu' => $this->faker->name(),
            'jenjang' => $this->faker->randomElement(['SMK TKJ', 'SMK TKR', 'SMA', 'MA']),
            'kelas' => mt_rand(10, 12),
            'kampus' => 'kampus' . mt_rand(1, 4),
            'jenkel' =>  $this->faker->randomElement(['SANTRIWAN', 'SANTRIWATI']),
            // 'gedung' => 'Umar',
            // 'kamar' => mt_rand(100,120)
        ];
    }
}
