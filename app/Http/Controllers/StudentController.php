<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('class')->get(); // Make sure the relationship name is correct
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $students = User::where('role', 'Student')->get();
        $classes = Classes::all(); // Change 'ClassModel' to the appropriate class model name
        return view('students.create', compact('students', 'classes'));
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
