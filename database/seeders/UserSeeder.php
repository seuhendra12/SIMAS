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
        User::create([
			'name' => 'Super Admin',
			'email' => 'superadmin@gmail.com',
			'role' => 'Admin',
			'password' => Hash::make('Admin12345'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);
        User::create([
			'name' => 'Seuhendra Setiawan',
			'email' => 'seuhendra12@gmail.com',
			'role' => 'User',
			'password' => Hash::make('Admin12345'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);
    }
}
