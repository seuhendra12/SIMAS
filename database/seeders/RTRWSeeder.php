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
    RT::create([
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
    ]);

    // Mengisi tabel dengan data RW
    RW::create([
      ['name' => 'I'],
      ['name' => 'II'],
      ['name' => 'III'],
      ['name' => 'IV'],
      ['name' => 'V'],
      ['name' => 'VI'],
    ]);
  }
}
