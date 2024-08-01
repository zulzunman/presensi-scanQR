<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $currentUserRole = auth()->user()->role;
        $perPage = 10; // Jumlah item per halaman

        if ($currentUserRole == 'teacher') {
            $users = User::where('role', '!=', 'admin')->paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }

        return view('users.index', compact('users', 'currentUserRole'));
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
            'role' => 'required|in:admin,teacher,student',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,teacher,student',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
