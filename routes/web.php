<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeReportController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\ClassOverviewController;
use App\Http\Controllers\ClassExportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RoleLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Public / Welcome
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('welcome');

/*
|--------------------------------------------------------------------------
| Role-based Login
|--------------------------------------------------------------------------
*/
Route::get('/login/{role}', [RoleLoginController::class, 'showLoginForm'])->name('login.role');
Route::post('/login/{role}', [RoleLoginController::class, 'login'])->name('login.role.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Main Dashboard (redirects based on role)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Finance (Director only)
|--------------------------------------------------------------------------
*/
Route::prefix('finance')->middleware(['auth', 'role:director'])->name('finance.')->group(function () {
    Route::get('/', [FinanceController::class, 'index'])->name('dashboard');

    // Fees
    Route::get('/fees', [FinanceController::class, 'manageFees'])->name('fees');
    Route::get('/fees/create', [FinanceController::class, 'createFee'])->name('fees.create');
    Route::post('/fees/store', [FinanceController::class, 'storeFee'])->name('fees.store');
    Route::get('/fees/{id}/edit', [FinanceController::class, 'editFee'])->name('fees.edit');
    Route::put('/fees/{id}', [FinanceController::class, 'updateFee'])->name('fees.update');
    Route::delete('/fees/{id}', [FinanceController::class, 'destroyFee'])->name('fees.destroy');

    // Fee breakdowns
    Route::get('/breakdowns', [FinanceController::class, 'manageBreakdowns'])->name('breakdowns');
    Route::post('/breakdowns/store', [FinanceController::class, 'storeBreakdown'])->name('breakdowns.store');
    Route::delete('/breakdowns/{id}', [FinanceController::class, 'destroyBreakdown'])->name('breakdowns.destroy');
    Route::get('/breakdowns/print/{term}', [FinanceController::class, 'printBreakdown'])->name('breakdowns.print');

    // Student reports
    Route::get('/student/{id}/report', [FinanceController::class, 'studentReport'])->name('student.report');
    Route::get('/student/{id}/print', [FinanceController::class, 'printStudentReport'])->name('student.print');

    // Payments
    Route::get('/payments/{student}', [FinanceController::class, 'studentPayments'])->name('payments.index');
    Route::post('/payments/{student}', [FinanceController::class, 'storePayment'])->name('payments.store');

    // Employees
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});

/*
|--------------------------------------------------------------------------
| Director-only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:director'])->group(function () {
    Route::resource('admins', AdminController::class)->only(['index','create','store','destroy']);
    Route::get('/director/dashboard', [DashboardController::class, 'director'])->name('director.dashboard');
    Route::get('/director/finances', [App\Http\Controllers\FinanceController::class, 'index'])
        ->name('director.finances');
});

/*
|--------------------------------------------------------------------------
| Director + Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:director,admin'])->group(function () {
    Route::resource('teachers', TeacherController::class);
    Route::resource('fees', FeeController::class);
    Route::get('/fees/report', [FeeReportController::class, 'index'])->name('fees.report');
    Route::resource('student-fees', StudentFeeController::class)->only(['index','create','store']);
    Route::resource('classes', ClassOverviewController::class);
    Route::get('/classes/export/{class_name}/pdf', [ClassExportController::class, 'exportPdf'])->name('classes.export.pdf');
    Route::get('/classes/export/{class_name}/excel', [ClassExportController::class, 'exportExcel'])->name('classes.export.excel');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Shared payments view for Admin/Director
    Route::get('/payments/{student}', [FinanceController::class, 'studentPayments'])->name('payments.index');
    Route::post('/payments/{student}', [FinanceController::class, 'storePayment'])->name('payments.store');

    Route::get('/director/finances', [FinanceController::class, 'index'])->name('director.finances');

});

/*
|--------------------------------------------------------------------------
| Teacher only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
});

/*
|--------------------------------------------------------------------------
| Common routes (All roles)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:director,admin,teacher'])->group(function () {
    Route::resource('students', StudentController::class);
    Route::get('/classes', [ClassOverviewController::class, 'index'])->name('classes.index');
});

/*
|--------------------------------------------------------------------------
| Auth Scaffolding
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
