<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        // Dapatkan user yang sedang login
        $userData = auth()->user();

        $role = Auth::user()->role;

        $classes = Classes::all();
        return view('classes.index', compact('classes', 'role', 'userData'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Classes::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function show($id)
    {
        $class = Classes::findOrFail($id);
        return view('classes.show', compact('class'));
    }

    public function edit($id)
    {
        $class = Classes::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class = Classes::findOrFail($id);
        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }
}
