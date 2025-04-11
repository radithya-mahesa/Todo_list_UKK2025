<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;
use Illuminate\Support\Facades\Route;

// Main page
Route::get('/', function () {
    return view('layouts.home');
})->name('home');

// Auth
Route::get('/login', function () {
    return view('layouts.login-page');
})->name('login');

Route::get('/register', function () {
    return view('layouts.register-page');
})->name('register');

// Route::get('/logout', function () {
//     abort(404);
// });

Route::fallback(function () {
    abort(404);
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Dashboard 
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::patch('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'markAsCompleted'])->name('tasks.complete');
    
    // Subtasks
    Route::post('/tasks/{id}/subtasks', [TaskController::class, 'addSubtask'])->name('tasks.addSubtask');
    Route::get('/tasks/{task}/subtasks', [TaskController::class, 'getSubtasks']);
    Route::patch('/subtasks/{subtask}/status', [SubtaskController::class, 'updateStatus']);
    Route::post('/subtasks', [SubtaskController::class, 'store'])->name('subtasks.store');
    Route::delete('/subtasks/{id}', [SubtaskController::class, 'destroy'])->name('subtasks.destroy');

});
