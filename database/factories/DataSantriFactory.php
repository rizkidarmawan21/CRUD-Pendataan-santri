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
            'no_telp' => $this->faker->phoneNumber(),
            'nama_ortu' => $this->faker->name(),
            'jenjang' => 'SMK',
            'kelas' => mt_rand(10,12),
            'kampus' => 'kampus' . mt_rand(1,4),
            'gedung' => 'Umar',
            'kamar' => mt_rand(100,120)
        ];
    }
}
