<?php

namespace Database\Factories;

use App\Models\PaktaIntegritas;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaktaIntegritasFactory extends Factory
{
    protected $model = PaktaIntegritas::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'jabatan' => $this->faker->jobTitle,
            'instansi' => $this->faker->company,
            'alamat' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'kota' => $this->faker->city,
            'tanggal' => $this->faker->date(),
            'no_whatsapp' => $this->faker->phoneNumber,
            'identitas_diri' => $this->faker->imageUrl(),
            'role' => $this->faker->randomElement(['pegawai', 'penyedia-jasa', 'pengguna-jasa', 'auditor']),
            'status' => $this->faker->randomElement(['diterima', 'ditolak']),
            'tanggal_akhir' => $this->faker->dateTimeBetween('+1 year', '+2 years')->format('Y-m-d'),
        ];
    }
}
