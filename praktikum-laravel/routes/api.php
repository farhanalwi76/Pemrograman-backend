<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\StudentController;

#menthod Get
// Menampilkan data hewan  Animals
Route::get('/animals', [AnimalController::class, 'index']);

#menthod Post
// Menambahkan Animals hewan baru 
Route::post('/animals', [AnimalController::class, 'store']);

#menthod Put
// Mengupdate hewan 
Route::put('/animals/{id}', [AnimalController::class, 'update']);

#menthod Delete
// Menghapus hewan 
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);

// Route students
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::get('/students/{id}', [StudentController::class, 'show']);