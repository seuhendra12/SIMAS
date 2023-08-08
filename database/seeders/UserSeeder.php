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
				'nik' => '2172027105050001',
				'name' => 'Super Admin',
				'role' => 'SuperAdmin',
				'password' => Hash::make('Superadmin12345'),
			],
			[
				'nik' => '2172027105050002',
				'name' => 'Admin',
				'role' => 'Admin',
				'password' => Hash::make('Admin12345'),
			],
			[
				'nik' => '2172027105050003',
				'name' => 'Kelurahan Koto Luar',
				'role' => 'Kelurahan',
				'password' => Hash::make('Kelurahan12345'),
			],
			[
				'nik' => '2102082009010003',
				'name' => 'Seuhendra Setiawan',
				'role' => 'User',
				'password' => Hash::make('Suen200901'),
			],
		];

		foreach ($users as $userData) {
			$user=User::create([
				'nik' => $userData['nik'],
				'name' => $userData['name'],
				'role' => $userData['role'],
				'password' => $userData['password'],
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			]);

			$user->profile()->create([
				'user_id' => $user->id,
				// Isi dengan kolom-kolom lain yang ada dalam tabel profil
			]);
		}
	}
}
