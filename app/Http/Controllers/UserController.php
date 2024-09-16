<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $currentUserRole = auth()->user()->role;
        $perPage = 1000000000000; // Jumlah item per halaman

        $role = Auth::user()->role;
        // Dapatkan user yang sedang login
        $userData = auth()->user();

        if ($currentUserRole == 'teacher') {
            $users = User::where('role', '!=', 'admin')->paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }

        return view('users.index', compact('users', 'currentUserRole', 'role', 'userData'));
    }
    public function create()
    {
        $role = Auth::user()->role;
        return view('users.create',  ['role' => $role]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,teacher,student,picket_teacher',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dibuat.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'), ['role' => $role]);
    }

    public function update(Request $request, $id)
    {

        $currentUserRole = auth()->user()->role;
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,teacher,student,picket_teacher',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        if ($currentUserRole == 'admin') {
            return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
        } elseif ($currentUserRole == 'teacher') {
            return redirect()->route('teachers.index')->with('success', 'Pengguna berhasil diperbarui.');
        } else {
            return redirect()->route('students.index')->with('success', 'Pengguna berhasil diperbarui.');
        }

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function import(Request $request)
    {
        // Validasi file yang di-upload (opsional)
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Proses import file Excel
        try {
            Excel::import(new UserImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data Berhasil Diimpor');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
