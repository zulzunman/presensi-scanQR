<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        // Tampilkan semua data presensi
        $attendances = Attendance::all();
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        // Tampilkan form untuk membuat presensi baru
        return view('attendances.create', compact('students', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $attend = new Attendance([
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'date' => now()->toDateString(), // Mengatur tanggal ke waktu saat ini
            'time' => now()->toTimeString(),
        ]);
        $attend->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance created successfully.');
    }
}
