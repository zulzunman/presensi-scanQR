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
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login
        if ($user->role == 'admin') {
            // Jika pengguna adalah admin, tampilkan semua data guru
            $teachers = Teacher::with('user', 'subject')->get();
            $attendances = Attendance::all();
        } elseif ($user->role == 'teacher') {
            // Jika pengguna adalah guru, tampilkan data sesuai dengan ID guru pada pengguna
            $teachers = Teacher::with('user', 'subject')->where('user_id', $user->id)->get();
            $attendances = Attendance::all();
        } else {
            // Jika peran lain, misalnya siswa atau lainnya, bisa ditambahkan kondisi lain atau menampilkan error
            return abort(403, 'Unauthorized action.');
        }
        return view('attendances.index', compact('attendances', 'teachers'));
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
