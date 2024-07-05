<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat 5 data siswa random
        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'username' => 'student'.$i,
                'password' => bcrypt('password'), // Ganti dengan password yang sesuai
                'role' => 'student',
            ]);

            Student::create([
                'name' => 'Student '.$i,
                'class' => 'Class '.$i,
                'user_id' => $user->id,
            ]);
        }
    }
}
