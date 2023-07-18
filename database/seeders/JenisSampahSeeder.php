<?php

namespace Database\Seeders;

use App\Models\JenisSampah;
use App\Models\KategoriSampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoriOrganik = KategoriSampah::where('name', 'Organik')->first();
        $kategoriAnorganik = KategoriSampah::where('name', 'Anorganik')->first();

        JenisSampah::create([
            'name' => 'Sisa Makanan',
            'kategori_sampah_id' => $kategoriOrganik->id,
            'point_perkg' => 10
        ]);

        JenisSampah::create([
            'name' => 'Kertas',
            'kategori_sampah_id' => $kategoriAnorganik->id,
            'point_perkg' => 15
        ]);

        JenisSampah::create([
            'name' => 'Gelas Plastik',
            'kategori_sampah_id' => $kategoriAnorganik->id,
            'point_perkg' => 20
        ]);

        JenisSampah::create([
            'name' => 'Botol Plastik',
            'kategori_sampah_id' => $kategoriAnorganik->id,
            'point_perkg' => 30
        ]);

        // Tambahkan jenis sampah lainnya di sini dengan mengikuti pola yang sama

    }
}
