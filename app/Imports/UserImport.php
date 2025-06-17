<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToCollection, WithStartRow
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
            User::firstOrCreate(
                ['username' => $row[0]],
                [
                    'role' => 'student',
                    'password' => Hash::make('12345678'),
                ]
            );
        }
    }
}
