<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Api\EmployeeController as ApiEmployeeController;
use App\Http\Controllers\Api\AuthController;


// ==========================================
// ACTIVITY 2 - STUDENT API
// ==========================================

Route::get('/students', function () {
    return response()->json(Student::all());
});

Route::post('/students', function (Request $request) {

    $student = Student::create([
        'name' => $request->name,
        'course' => $request->course,
        'contact' => $request->contact
    ]);

    return response()->json([
        'message' => 'Student created successfully',
        'student' => $student
    ], 201);

});


// ==========================================
// ACTIVITY 3 - EMPLOYEE API VERSION 1
// ==========================================

Route::prefix('v1')->group(function () {

    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

});


// ==========================================
// ACTIVITY 6 - AUTHENTICATION
// ==========================================

// Public routes - no token required
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// ==========================================
// PROTECTED EMPLOYEE ROUTES
// ACTIVITIES 4, 5 AND 6
// ==========================================

Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Employee CRUD
    Route::get('/employees', [ApiEmployeeController::class, 'index']);
    Route::post('/employees', [ApiEmployeeController::class, 'store']);
    Route::get('/employees/{id}', [ApiEmployeeController::class, 'show']);
    Route::put('/employees/{id}', [ApiEmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [ApiEmployeeController::class, 'destroy']);

});