<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        // Dapatkan user yang sedang login
        $userData = auth()->user();

        $students = Student::with('class')->get(); // Make sure the relationship name is correct

        $currentUserRole = auth()->user()->role;
        if ($userData->role == 'admin') {
            // Jika pengguna adalah admin, tampilkan semua data guru
            $students = Student::with('class')->get();
            // Mendapatkan data users, misalnya untuk dropdown di modal
            $users = User::where('role', 'Student')
            ->leftJoin('students', 'users.id', '=', 'students.user_id')
            ->whereNull('students.user_id')
            ->select('users.*')
            ->get();
        } elseif ($userData->role == 'student') {
            // Jika pengguna adalah guru, tampilkan data sesuai dengan ID guru pada pengguna
            $students = Student::with('class')->where('user_id', $userData->id)->get();
            // Mendapatkan data users, misalnya untuk dropdown di modal
            $users = User::where('id', $userData->id)->get();
        } else {
            // Jika peran lain, misalnya siswa atau lainnya, bisa ditambahkan kondisi lain atau menampilkan error
            return abort(403, 'Unauthorized action.');
        }

        $classes = Classes::all(); // Ambil semua data kelas
        return view('students.index', compact('students', 'classes', 'users', 'currentUserRole', 'userData'));
    }

    public function create()
    {
        $classes = Classes::all(); // Change 'ClassModel' to the appropriate class model name
        // $users = User::where('role', 'Student')->get();
        // Mengambil data User dengan role 'Student' yang belum ada di tabel students
        $users = User::where('role', 'Student')
        ->leftJoin('students', 'users.id', '=', 'students.user_id')
        ->whereNull('students.user_id')
        ->select('users.*')
        ->get();
        return view('students.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'class_id' => 'required|exists:classes,id',
        ]);

        Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil dibuat.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $users = User::where('role', 'Student')->get();
        $classes = Classes::all(); // Change 'ClassModel' to the appropriate class model name

        return view('students.edit', compact('student', 'users', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'class_id' => 'required|exists:classes,id',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }

    public function import(Request $request)
    {
        // Validasi file yang di-upload (opsional)
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Proses import file Excel
        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data Berhasil Diimpor');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
