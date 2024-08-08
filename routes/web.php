<?php

use App\Http\Controllers\birthdayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/', [birthdayController::class, 'index']); // Ganti rute untuk memanggil fungsi index di BirthdayController

// Rute untuk karyawan
Route::resource('employees', EmployeeController::class); // Menggunakan resource untuk CRUD
Route::get('/employees/import/data', [EmployeeController::class, 'importPage'])->name('employees.importPage.data');
Route::post('/employees/import/data', [EmployeeController::class, 'import'])->name('employees.import.data');