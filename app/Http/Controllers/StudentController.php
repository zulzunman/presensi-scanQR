<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        // Dapatkan user yang sedang login
        $userData = auth()->user();

        $students = Student::with('class')->get(); // Make sure the relationship name is correct

        $role = Auth::user()->role;
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
            $users = User::all();
        } else {
            // Jika peran lain, misalnya siswa atau lainnya, bisa ditambahkan kondisi lain atau menampilkan error
            return abort(403, 'Unauthorized action.');
        }

        $classes = Classes::all(); // Ambil semua data kelas
        return view('students.index', compact('students', 'classes', 'users', 'role', 'userData'));
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
        $request->validate([
            'nis' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'class_id' => 'required|exists:classes,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
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
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'class_id' => 'required|exists:classes,id',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
