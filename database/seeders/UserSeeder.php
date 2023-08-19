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
				'nik' => '0000000000000001',
				'name' => 'Super Admin',
				'role' => 'SuperAdmin',
				'is_active'=>1,
				'password' => Hash::make('Superadmin12345'),
			],
			[
				'nik' => '0000000000000002',
				'name' => 'Admin',
				'role' => 'Admin',
				'is_active'=>1,
				'password' => Hash::make('Admin12345'),
			],
			[
				'nik' => '0000000000000003',
				'name' => 'Kelurahan Koto Luar',
				'role' => 'Kelurahan',
				'is_active'=>1,
				'password' => Hash::make('Kelurahan12345'),
			],
			[
				'nik' => '0000000000000004',
				'name' => 'RT',
				'role' => 'RT',
				'is_active'=>1,
				'password' => Hash::make('Rt123456'),
			],
			[
				'nik' => '0000000000000005',
				'name' => 'RW',
				'role' => 'RW',
				'is_active'=>1,
				'password' => Hash::make('Rw123456'),
			],
			[
				'nik' => '0000000000000006',
				'name' => 'Petugas 1',
				'role' => 'Petugas',
				'is_active'=>1,
				'password' => Hash::make('Petugas12345'),
			],
		];

		foreach ($users as $userData) {
			$user=User::create([
				'nik' => $userData['nik'],
				'name' => $userData['name'],
				'role' => $userData['role'],
				'is_active' => $userData['is_active'],
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
