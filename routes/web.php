<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;
use App\Models\Task;

Route::get('/', function () {
    return view('layouts.home');
})->name('home');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('layouts.login-page');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('layouts.dashboard');


// Route untuk menampilkan halaman tasks
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Route untuk menyimpan task baru
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Route untuk mendapatkan detail task berdasarkan ID
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

// Route untuk memperbarui status task (misalnya menyelesaikan task)
// Route::patch('/tasks/{id}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::patch('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');

// Route untuk menghapus task
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');


// Route untuk menambahkan subtask
Route::post('/tasks/{id}/subtasks', [TaskController::class, 'addSubtask'])->name('tasks.addSubtask');

// Route::resource('tasks', TaskController::class);

Route::patch('/subtasks/{subtask}/status', [SubtaskController::class, 'updateStatus']);
Route::post('/subtasks', [SubtaskController::class, 'store'])->name('subtasks.store');
Route::delete('/subtasks/{id}', [SubtaskController::class, 'destroy'])->name('subtasks.destroy');

Route::get('/tasks/{task}/subtasks', [TaskController::class, 'getSubtasks']);




