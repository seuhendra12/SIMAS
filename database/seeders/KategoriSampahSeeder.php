<?php

namespace Database\Seeders;

use App\Models\KategoriSampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriSampah::create([
            'name' => 'Organik',
            'deskripsi' => 'Sampah organik adalah jenis sampah yang berasal dari sisa-sisa bahan organik yang dapat terurai secara alami. Sampah organik umumnya terdiri dari bahan-bahan seperti sisa makanan, daun, ranting, kulit buah, kertas yang terkontaminasi dengan bahan organik, dan limbah pertanian. Sampah organik dapat terdekomposisi melalui proses alami oleh mikroorganisme seperti bakteri dan jamur.'
        ]);
        
        KategoriSampah::create([
            'name' => 'Anorganik',
            'deskripsi' => 'Sampah anorganik adalah jenis sampah yang tidak dapat terurai secara alami atau membutuhkan waktu yang sangat lama untuk terurai. Sampah anorganik terdiri dari bahan-bahan seperti plastik, kaca, logam, kertas yang tidak terkontaminasi oleh bahan organik, kain sintetis, styrofoam, dan berbagai jenis bahan kimia. Sampah anorganik umumnya tidak dapat terurai melalui proses alami dan cenderung bertahan dalam lingkungan untuk waktu yang lama jika tidak dikelola dengan benar.'
        ]);
        
        KategoriSampah::create([
            'name' => 'TPA',
            'deskripsi' => 'Tempat Pembuangan Akhir adalah area atau lokasi yang digunakan untuk mengumpulkan dan menangani sampah yang tidak dapat didaur ulang atau diolah kembali. TPA merupakan tempat terakhir dalam rantai pengelolaan sampah, di mana sampah yang tidak dapat diolah lebih lanjut akan dibuang dan ditimbun di area khusus yang telah dirancang untuk tujuan tersebut.'
        ]);
        
    }
}
