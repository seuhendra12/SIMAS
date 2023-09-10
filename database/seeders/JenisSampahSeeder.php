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
        $kategoriTPA = KategoriSampah::where('name', 'TPA')->first();

        JenisSampah::create([
            'name' => 'Tempat Pembuangan Akhir',
            'kategori_sampah_id' => $kategoriTPA->id,
            'point_perkg' => 1,
            'harga_per_kg' => 0
        ]);
        
        JenisSampah::create([
            'name' => 'Sisa Makanan',
            'kategori_sampah_id' => $kategoriOrganik->id,
            'point_perkg' => 5,
            'harga_per_kg' => 1000
        ]);

        JenisSampah::create([
            'name' => 'Kertas',
            'kategori_sampah_id' => $kategoriAnorganik->id,
            'point_perkg' => 10,
            'harga_per_kg' => 2000
        ]);

        JenisSampah::create([
            'name' => 'Gelas Plastik',
            'kategori_sampah_id' => $kategoriAnorganik->id,
            'point_perkg' => 15,
            'harga_per_kg' => 3000
        ]);

        JenisSampah::create([
            'name' => 'Botol Plastik',
            'kategori_sampah_id' => $kategoriAnorganik->id,
            'point_perkg' => 20,
            'harga_per_kg' => 4000
        ]);

        // Tambahkan jenis sampah lainnya di sini dengan mengikuti pola yang sama

    }
}
