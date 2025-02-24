<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return redirect('work_records');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // WORK RECORDS REPORT CSV
    Route::get('work_records/export', [WorkRecordController::class, 'export'])->name('work_records.export');

    // WORK RECORDS CRUD ROUTES
    Route::resource('work_records', WorkRecordController::class);

});

require __DIR__ . '/auth.php';
