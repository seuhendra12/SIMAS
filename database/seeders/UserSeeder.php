<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = User::create([
			'name' => 'Super Admin',
			'email' => 'superadmin@gmail.com',
			'role' => 'Pengelola',
			'password' => Hash::make('Admin12345'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		// Buat objek profil terkait dan isi data nik secara otomatis
		$user->profile()->create([
			'nik' => '2102082009010003', // Isi dengan nilai nik yang diinginkan
			// Isi dengan kolom-kolom lain yang ada dalam tabel profil
		]);
	}
}
