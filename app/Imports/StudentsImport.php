<?php

namespace App\Imports;

use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentsImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            // Step 1: Create or find the user
            $user = User::firstOrCreate(
                ['username' => $row[1]],
                [
                    'role' => 'student',
                    'password' => Hash::make('12345678'),
                ]
            );

            // Step 2: Check if class exists, if not, create it
            $class = Classes::where('name', $row[3])->first();

            if (!$class) {
                $class = Classes::create(['name' => $row[3]]);
            }

            // Step 3: Create the student with user_id and class_id
            Student::create([
                'nis'      => $row[0],
                'name'     => $row[1],
                'jenis_kelamin'   => $row[2],
                'user_id'  => $user->id,
                'class_id' => $class->id,
            ]);
        }
    }
}
