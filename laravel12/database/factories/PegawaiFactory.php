<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pegawai' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'umur' => $this->faker->numberBetween(16,60),
            'tanggal_lahir' => $this->faker->date(), 
            'tempat_lahir' => $this->faker->city(),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki','perempuan']),
        
        ];
    }
}
