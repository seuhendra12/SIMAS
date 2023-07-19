<?php

namespace Database\Seeders;

use App\Models\User;
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
		$users = [
			[
				'name' => 'Pengelola',
				'email' => 'pengelola@gmail.com',
				'role' => 'Pengelola',
				'password' => Hash::make('Pengelola12345'),
				'nik' => '2172027105050002',
			],
			[
				'name' => 'Kelurahan Koto Luar',
				'email' => 'kelurahan@gmail.com',
				'role' => 'Kelurahan',
				'password' => Hash::make('Kelurahan12345'),
				'nik' => '2172027105050004',
			],
			[
				'name' => 'Warga RT 02',
				'email' => 'warga@gmail.com',
				'role' => 'Warga',
				'password' => Hash::make('Warga12345'),
				'nik' => '2172027105050003',
			],
		];

		foreach ($users as $userData) {
			$user = User::create([
				'name' => $userData['name'],
				'email' => $userData['email'],
				'role' => $userData['role'],
				'password' => $userData['password'],
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			]);

			$user->profile()->create([
				'nik' => $userData['nik'],
				// Isi dengan kolom-kolom lain yang ada dalam tabel profil
			]);
		}
	}
}
