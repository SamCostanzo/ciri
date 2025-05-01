<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']); // Show tasks
Route::post('/tasks', [TaskController::class, 'store']); // Add a task
Route::post('/tasks/{task}/complete', [TaskController::class, 'complete']); // Mark task as complete
Route::post('/tasks/{task}/incomplete', [TaskController::class, 'incomplete']); // Mark task as incomplete (goes back into task list)
Route::post('/tasks/{task}/delete', [TaskController::class, 'delete']); // Delete task
Route::delete('/tasks/clear', [TaskController::class, 'clearTasks'])->name('tasks.clear'); // Clear task list
Route::delete('/tasks/clearcompleted', [TaskController::class, 'clearCompleted'])->name('tasks.clearcompleted'); // Clear completed list
// Test comment