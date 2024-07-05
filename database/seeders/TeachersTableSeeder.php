<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat 5 data guru random
        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'username' => 'teacher'.$i,
                'password' => bcrypt('12345678'), // Ganti dengan password yang sesuai
                'role' => 'teacher',
            ]);

            Teacher::create([
                'name' => 'Teacher '.$i,
                'user_id' => $user->id,
            ]);
        }
    }
}
