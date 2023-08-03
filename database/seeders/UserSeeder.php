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
				'name' => 'Super Admin',
				'email' => 'superadmin@gmail.com',
				'role' => 'SuperAdmin',
				'password' => Hash::make('Superadmin12345'),
				'nik' => '2172027105050001',
			],
			[
				'name' => 'Admin',
				'email' => 'admin@gmail.com',
				'role' => 'Admin',
				'password' => Hash::make('Admin12345'),
				'nik' => '2172027105050002',
			],
			[
				'name' => 'Kelurahan Koto Luar',
				'email' => 'kelurahan@gmail.com',
				'role' => 'Kelurahan',
				'password' => Hash::make('Kelurahan12345'),
				'nik' => '2172027105050003',
			],
			[
				'name' => 'Seuhendra Setiawan',
				'email' => 'seuhendrasetiawan.com',
				'role' => 'User',
				'password' => Hash::make('Seu12345'),
				'nik' => '2172027105050004',
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
