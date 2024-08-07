<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        // Dapatkan user yang sedang login
        $userData = auth()->user();

        // Mengambil semua mata pelajaran
        $subjects = Subject::all();

        $role = Auth::user()->role;

        if ($userData->role == 'admin') {
            // Jika pengguna adalah admin, tampilkan semua data guru
            $teachers = Teacher::with('user', 'subject')->get();
            // Mendapatkan data users, misalnya untuk dropdown di modal
            $users = User::where('role', 'teacher')
            ->leftJoin('teachers', 'users.id', '=', 'teachers.user_id')
            ->whereNull('teachers.user_id')
            ->select('users.*')
            ->get();
            // dd($users);
        } elseif ($userData->role == 'teacher') {
            // Jika pengguna adalah guru, tampilkan data sesuai dengan ID guru pada pengguna
            $teachers = Teacher::with('user', 'subject')->where('user_id', $userData->id)->get();
            // Mendapatkan data users, misalnya untuk dropdown di modal
            $users = User::all();
        } else {
            // Jika peran lain, misalnya siswa atau lainnya, bisa ditambahkan kondisi lain atau menampilkan error
            return abort(403, 'Unauthorized action.');
        }

        return view('teachers.index', compact('teachers', 'users', 'subjects', 'role', 'userData'));
    }

    public function create()
    {
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login

        // Ambil semua subjects
        $subjects = Subject::all();

        // Cek peran pengguna dan ambil data teachers sesuai peran
        if ($user->role == 'admin') {
            // Jika pengguna adalah admin, ambil semua data guru
            $teachers = User::where('role', 'Teacher')->get();
        } elseif ($user->role == 'teacher') {
            // Jika pengguna adalah guru, ambil data guru yang sesuai dengan ID pengguna
            $teachers = User::where('role', 'Teacher')->where('id', $user->id)->get();
        } else {
            // Jika peran lain, misalnya siswa atau lainnya, bisa ditambahkan kondisi lain atau menampilkan error
            return abort(403, 'Unauthorized action.');
        }
        return view('teachers.create', compact('teachers', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Menyimpan data teacher ke database
        $teacher = Teacher::create($request->all());

        // Memanggil fungsi generateQr untuk menghasilkan QR code
        $this->generateQr($teacher->id);

        return redirect()->route('teachers.index')->with('success', 'Teacher created and QR code generated successfully.');
    }

    // Fungsi generateQr
    public function generateQr($id)
    {
        $teacher = Teacher::findOrFail($id);

        $data = [
            'id' => $teacher->id,
            'name' => $teacher->name,
            'nip' => $teacher->nip,
            'jenis_kelamin' => $teacher->jenis_kelamin,
            'subject_id' => $teacher->subject_id
        ];

        // Generate QR code
        $qrCode = QrCode::format('png')->size(300)->generate(json_encode($data));

        // Nama file QR code
        $fileName = 'teacher-' . $teacher->id . '.png';
        $filePath = public_path('assets/qrcodes/' . $fileName);

        // Simpan QR code ke file
        file_put_contents($filePath, $qrCode);

        // Simpan nama file QR ke database
        $teacher->qr_name = $fileName;
        $teacher->save();

        return response()->json(['file_path' => asset('assets/qrcodes/' . $fileName)]);
    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login

        // Ambil data guru berdasarkan ID
        $teacher = Teacher::findOrFail($id);

        // Ambil semua subjects
        $subjects = Subject::all();

        // Cek peran pengguna dan ambil data teachers sesuai peran
        if ($user->role == 'admin') {
            // Jika pengguna adalah admin, ambil semua data guru
            $users = User::where('role', 'Teacher')->get();
        } elseif ($user->role == 'teacher') {
            // Jika pengguna adalah guru, ambil data guru yang sesuai dengan ID pengguna
            $users = User::where('role', 'Teacher')->where('id', $user->id)->get();
        } else {
            // Jika peran lain, misalnya siswa atau lainnya, bisa ditambahkan kondisi lain atau menampilkan error
            return abort(403, 'Unauthorized action.');
        }

        return view('teachers.edit', compact('teacher', 'users', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
