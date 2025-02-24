<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WorkRecordController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // WORK RECORDS REPORT CSV
    Route::get('work_records/export', [WorkRecordController::class, 'export']);

    // WORK RECORDS CRUD ROUTES
    Route::apiResource('work_records', WorkRecordController::class);

});