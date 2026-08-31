<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Student;

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