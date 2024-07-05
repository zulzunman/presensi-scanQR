<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat 5 data jadwal pelajaran random
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        for ($i = 0; $i < 5; $i++) {
            $subject = Subject::inRandomOrder()->first();

            Schedule::create([
                'class' => 'Class '.$i,
                'subject_id' => $subject->id,
                'day' => $days[array_rand($days)],
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
            ]);
        }
    }
}
