<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeReportController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\ClassOverviewController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Director Routes
|--------------------------------------------------------------------------
| Only the Director can create or manage Admin accounts
*/
Route::middleware(['auth', 'role:director'])->group(function () {
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
    Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
| Director, Admin, and Teacher can manage students
*/
Route::middleware(['auth', 'role:director,admin,teacher'])->group(function () {
    Route::resource('students', StudentController::class);
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
| Admins and Directors can manage teachers
*/
Route::middleware(['auth', 'role:director,admin'])->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
| Admins, Teachers, and Directors can manage/view students
*/
Route::middleware(['auth', 'role:director,admin,teacher'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
});

Route::middleware(['auth', 'role:director,admin'])->group(function () {
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
});

/*
|--------------------------------------------------------------------------
| Attendance Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:director,admin,teacher'])->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
});

Route::middleware(['auth', 'role:teacher,admin'])->group(function () {
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
});

// Only Director & Admin can access fees
Route::middleware(['auth', 'role:admin,director'])->group(function () {
    Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
    Route::get('/fees/create', [FeeController::class, 'create'])->name('fees.create');
    Route::post('/fees', [FeeController::class, 'store'])->name('fees.store');
    Route::get('/fees/{fee}/edit', [FeeController::class, 'edit'])->name('fees.edit');
    Route::put('/fees/{fee}', [FeeController::class, 'update'])->name('fees.update');
    Route::delete('/fees/{fee}', [FeeController::class, 'destroy'])->name('fees.destroy');
});

Route::middleware(['auth', 'role:admin,director'])->group(function () {
    Route::get('/fees/report', [FeeReportController::class, 'index'])->name('fees.report');
});


Route::middleware(['auth', 'role:admin,director'])->group(function () {
    Route::get('/student-fees', [StudentFeeController::class, 'index'])->name('student_fees.index');
    Route::get('/student-fees/create', [StudentFeeController::class, 'create'])->name('student_fees.create');
    Route::post('/student-fees', [StudentFeeController::class, 'store'])->name('student_fees.store');
});


Route::middleware(['auth', 'role:director,admin'])->group(function () {
    Route::get('/classes', [ClassOverviewController::class, 'index'])->name('classes.index');
    Route::get('/classes/{class_name}', [ClassOverviewController::class, 'show'])->name('classes.show');
});


// Director/Admin middleware group
Route::middleware(['auth', 'role:director,admin'])->group(function () {
    Route::get('/export-class', [ReportController::class, 'exportClass'])->name('export.class');
    Route::get('/export-pdf', [ReportController::class, 'exportPDF'])->name('export.pdf');
});



require __DIR__.'/auth.php';
