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
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@src.com',
            'password' => Hash::make('12345678'),
            'community' => 'admin comunity',
            'pob' => 'Sukabumi',
            'dob' => now(),
            'address' => 'admin address',
            'phone' => '123890',
        ]);

        $admin->assignRole('admin');
    }
}
