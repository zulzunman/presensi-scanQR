<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        // Dapatkan user yang sedang login
        $userData = auth()->user();

        // Load attendance data with related student, teacher, and subject information
        $attendances = Attendance::with(['student.class', 'teacher.schedule.subject'])->get();

        if ($userData->role == 'admin') {
            $teachers = Teacher::with('user', 'subject', 'schedule')->get();
            $students = Student::with('class')->get();
            $study = Student::with('class')->get();
        } elseif ($userData->role == 'teacher') {
            $teachers = Teacher::with('user', 'subject', 'schedule')->where('user_id', $userData->id)->get();
            $students = Student::with('class')->get();
            $study = Student::with('class')->get();
        } elseif ($userData->role == 'student') {
            $teachers = Teacher::with('user', 'subject', 'schedule')->get();
            $students = Student::with('class')->where('user_id', $userData->id)->first();
            $study = Student::with('class')->get();
        } elseif ($userData->role == 'picket_teacher') {
            $teachers = Teacher::with('user', 'subject', 'schedule')->get();
            $students = Student::with('class')->where('user_id', $userData->id)->first();
            $study = Student::with('class')->get();
        }

        return view('attendances.index', compact('attendances', 'teachers', 'userData', 'students', 'study'));
    }

    public function addManual(Request $request)
    {
        $attendance = new Attendance;
        $attendance->student_id = $request->student_id;
        $attendance->teacher_id = $request->teacher_id;
        $attendance->status = $request->keterangan;
        $attendance->date = now()->toDateString();
        $attendance->time = now()->toTimeString();
        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance created successfully.');
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
            'status' => 'Hadir',
            'date' => now()->toDateString(), // Mengatur tanggal ke waktu saat ini
            'time' => now()->toTimeString(),
        ]);
        $attend->save();

        // Mengembalikan respons JSON
        return response()->json(['status' => 'success', 'message' => 'Data saved successfully!']);
    }

    public function regenerateQrCode($id)
    {
        try {
            // Cari teacher berdasarkan ID
            $teacher = Teacher::findOrFail($id);

            // Tentukan path untuk menyimpan QR code
            $fileName = 'teacher-' . $teacher->id . '.png';
            $filePath = public_path('assets/qrcodes/' . $fileName);

            // Hapus QR code yang lama jika ada
            if (File::exists($filePath)) {
                File::delete($filePath);
                Log::info("Deleted old QR code for teacher ID: {$teacher->id}");
            }

            // Data untuk QR code dengan pola yang berbeda (misalnya, menambahkan timestamp)
            $data = [
                'id' => $teacher->id,
                'name' => $teacher->name,
                'nip' => $teacher->nip,
                'jenis_kelamin' => $teacher->jenis_kelamin,
                'subject_id' => $teacher->subject_id,
                'timestamp' => Carbon::now()->toDateTimeString() // Tambahkan timestamp
            ];

            // Generate QR code baru
            $qrCode = QrCode::format('png')->size(300)->generate(json_encode($data));

            // Simpan QR code ke file
            file_put_contents($filePath, $qrCode);
            Log::info("Generated new QR code for teacher ID: {$teacher->id}");

            // Simpan nama file QR ke database
            $teacher->qr_name = $fileName;
            $teacher->save();

            return response()->json([
                'status' => true,
                'message' => 'QR Code regenerated successfully',
                'file_path' => asset('assets/qrcodes/' . $fileName)
            ], 200);
        } catch (\Exception $e) {
            Log::error("Failed to regenerate QR code: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Failed to regenerate QR code',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
