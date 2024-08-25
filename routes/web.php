<?php

use App\Exports\TemplateExport;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/error', [LoginController::class, 'error'])->name('error');
// Route untuk dashboard berbeda berdasarkan role
Route::middleware(['auth'])->group(function () {
    Route::get('/', [LoginController::class, 'dashboard'])->name('dashboard');

    Route::resource('teachers', TeacherController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('users', UserController::class);
    Route::post('/scan-qr', [AttendanceController::class, 'showScanPage'])->name('save.scanned.data');
    Route::get('user/{id}/regenerate-qr-code', [AttendanceController::class, 'regenerateQrCode'])->name('user.regenerateQrCode');
    Route::get('attendance/add', [AttendanceController::class, 'addManual'])->name('attendance.add');
    Route::get('/download-template', function () {
        return Excel::download(new TemplateExport, 'template-data-siswa.xlsx');
    });
    Route::post('/import', function () {
        Excel::import(new StudentsImport, request()->file('file'));

        return redirect()->back()->with('success', 'Data Imported Successfully');
    })->name('import');
});
