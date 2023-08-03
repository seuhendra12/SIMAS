<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiKonversiSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $nilaiKonversi = [
      [
        'angka_konversi' => 1,
        'nilai_konversi' => 1000
      ],
      [
        'angka_konversi' => 2,
        'nilai_konversi' => 2000
      ],
      [
        'angka_konversi' => 5,
        'nilai_konversi' => 5000
      ],
      [
        'angka_konversi' => 7,
        'nilai_konversi' => 7000
      ],
      [
        'angka_konversi' => 10,
        'nilai_konversi' => 10000
      ],
    ];

    DB::table('nilai_konversis')->insert($nilaiKonversi);
  }
}
