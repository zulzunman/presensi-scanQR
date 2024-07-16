<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('class','subject')->get(); // Make sure the relationship name is correct
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $subjects = Subject::all(); // Change 'ClassModel' to the appropriate class model name
        $classes = Classes::all(); // Change 'ClassModel' to the appropriate class model name
        return view('schedules.create', compact('subjects', 'classes'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'class' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Buat jadwal baru
        $schedule = Schedule::create([
            'class' => $request->class,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json([
            'message' => 'Schedule created successfully',
            'schedule' => $schedule,
        ], 201);
    }
}
