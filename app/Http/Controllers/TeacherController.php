<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user','subject')->get();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = Subject::all(); // Change 'ClassModel' to the appropriate class model name
        $teachers = User::where('role', 'Teacher')->get();
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

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $users = User::where('role', 'Teacher')->get();
        $subjects = Subject::all(); // Change 'ClassModel' to the appropriate class model name

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
