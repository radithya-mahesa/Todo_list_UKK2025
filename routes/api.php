<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::put('/tasks/{task}', [TaskController::class, 'update']);
// Route::put('/task/{taskId}', [TaskController::class, 'update'])->name('task.update');
// Route::put('/tasks/{taskId}/subtasks/{subtaskId}', [TaskController::class, 'updateSubtask']);

