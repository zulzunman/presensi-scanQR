<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Buat data di tabel users terlebih dahulu
        $user = User::create([
            'username' => $row['Name'],  // Sesuaikan dengan kolom name di Excel
            'password' => Hash::make('12345678'), // Default password yang di-hash
            'role'     => 'student',  // Set role sebagai student
        ]);

        // Setelah user dibuat, buat data di tabel students dengan user_id dari user yang baru saja dibuat
        return new Student([
            'user_id'  => $user->id,
            'nis'      => $row['NIS'],    // Sesuaikan dengan heading kolom di Excel
            'name'     => $row['Name'],
            'gender'   => $row['Gender'],
            'class'    => $row['Class'],
        ]);
    }
}
