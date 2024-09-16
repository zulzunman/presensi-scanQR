<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        // Dapatkan user yang sedang login
        $userData = auth()->user();

        // Ambil data subjects dan classes untuk digunakan dalam modals
        $subjects = Subject::all();
        $classes = Classes::all();
        $teachers = Teacher::all();

        $role = Auth::user()->role;

        // Cek hak akses user
        if ($userData->role == 'admin') {
            // Jika user adalah admin, ambil semua data schedule
            $schedules = Schedule::with('class', 'subject','teacher')->get();
        } elseif ($userData->role == 'teacher') {
            // Jika user adalah teacher, ambil data schedule sesuai subject_id yang terkait dengan user
            $teacher = Teacher::with('user', 'subject')->where('user_id', $userData->id)->get();
            $teacherIds = $teacher->pluck('id'); // Asumsikan user memiliki relasi 'subjects'
            $schedules = Schedule::with('class', 'subject', 'teacher')
                ->whereIn('teacher_id', $teacherIds)
                ->get();
        } else {
            // Jika user tidak memiliki hak akses yang sesuai
            $schedules = collect(); // Mengembalikan koleksi kosong atau lakukan tindakan lainnya
        }

        return view('schedules.index', compact('schedules', 'subjects', 'classes', 'role', 'userData', 'teachers'));
    }

    public function create()
    {
        $subjects = Subject::all(); // Change 'ClassModel' to the appropriate class model name
        $classes = Classes::all(); // Change 'ClassModel' to the appropriate class model name
        $teachers = Teacher::all(); // Change 'ClassModel' to the appropriate class model name
        return view('schedules.create', compact('subjects', 'classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $classes = Classes::all(); // Change 'ClassModel' to the appropriate class model name

        return view('schedules.edit', compact('schedule', 'subjects', 'classes', 'teachers'));
    }

    // // Metode update
    // public function update(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'subject_id' => 'required|exists:subjects,id',
    //         'teacher_id' => 'required|exists:teachers,id',
    //         'class_id' => 'required|exists:classes,id',
    //         'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
    //         'start_time' => 'required|date_format:H:i',
    //         'end_time' => 'required|date_format:H:i|after:start_time',
    //     ]);


    //     $schedule = Schedule::findOrFail($id);
    //     $schedule->update($request->all());

    //     return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully');
    // }
    // Metode update
    public function update(Request $request, $id)
    {

        // Temukan jadwal berdasarkan ID
        $schedule = Schedule::findOrFail($id);

        // Update field-field yang diinginkan
        $schedule->subject_id = $request->input('subject_id');
        $schedule->teacher_id = $request->input('teacher_id');
        $schedule->class_id = $request->input('class_id');
        $schedule->day = $request->input('day');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');

        // Simpan perubahan
        $schedule->save();

        // Redirect dengan pesan sukses
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui');
    }


    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
