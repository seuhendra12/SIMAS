<?php

namespace Database\Seeders;

use App\Models\RT;
use App\Models\RW;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RTRWSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Mengisi tabel dengan data RT
    $rtData = [
      ['name' => '01'],
      ['name' => '02'],
      ['name' => '03'],
      ['name' => '04'],
      ['name' => '05'],
      ['name' => '06'],
      ['name' => '07'],
      ['name' => '08'],
      ['name' => '09'],
      ['name' => '10'],
    ];

    DB::table('rts')->insert($rtData);

    // Mengisi tabel dengan data RW
    $rwData = [
      ['name' => 'I'],
      ['name' => 'II'],
      ['name' => 'III'],
      ['name' => 'IV'],
      ['name' => 'V'],
      ['name' => 'VI'],
    ];

    DB::table('rws')->insert($rwData);
  }
}
