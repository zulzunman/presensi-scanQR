<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

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
            $attendances = Attendance::all();
            // Jika pengguna adalah guru, tampilkan data sesuai dengan ID guru pada pengguna
            $teachers = Teacher::with('user', 'subject')->where('user_id', $user->id)->get();
            return view('attendances.index', compact('attendances', 'teachers'));
        }
        return view('attendances.index', compact('attendances', 'teachers'));
    }

    public function showScanPage(Request $request)
    {
        $dataArray = json_decode($request->json('data'), true);
        $dataQR = $dataArray['id']; // Ambil data dari request
        $idAuth = auth()->user()->id;
        $students = Student::where('user_id', $idAuth)->pluck('id');

        $attend = new Attendance([
            'student_id' => $students[0],
            'teacher_id' => $dataQR,
            'date' => now()->toDateString(), // Mengatur tanggal ke waktu saat ini
            'time' => now()->toTimeString(),
        ]);
        $attend->save();

        // Mengembalikan respons JSON
        return response()->json(['status' => 'success', 'message' => 'Data saved successfully!']);
    }
}
