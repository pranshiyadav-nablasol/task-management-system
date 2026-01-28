<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;

// Public route
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require auth:sanctum)
//  This sets up:

// POST /api/login
// POST /api/logout
// GET /api/tasks
// POST /api/tasks
// GET /api/tasks/{id}
// PUT /api/tasks/{id}
// DELETE /api/tasks/{id} 

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('tasks', TaskController::class);
});