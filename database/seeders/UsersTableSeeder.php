<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan admin
        User::create([
            'username' => 'admin',
            'password' => bcrypt('12345678'), // Ganti dengan password yang sesuai
            'role' => 'admin',
        ]);
    }
}
