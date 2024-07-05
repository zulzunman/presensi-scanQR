<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat 5 data mata pelajaran random
        for ($i = 0; $i < 5; $i++) {
            $teacher = Teacher::inRandomOrder()->first();

            Subject::create([
                'name' => 'Subject '.$i,
                'teacher_id' => $teacher->id,
            ]);
        }
    }
}
