<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;


// General pages
Route::view('/about', 'about')
    ->name('about');

Route::view('/contact', 'contact')
    ->name('contact');

// Homepage is a guest view if not logged in, otherwise it shows your tasks
Route::get('/', function() {
        if (auth()->check()) {
            $user = auth()->user();
            $tasks = Task::where('user_id', $user->id)->get();
            return view('tasks.index', ['tasks' => $tasks]);
        } else {
            return view('guests');
        }
    })
    ->name('home');

// Individual task pages:
Route::get('/tasks/create', function () {
    return view('tasks.create');
})->name('task-create');

// Individual task edit:
Route::get('/tasks/edit/{id}', function ( $id ) {
    $task = Task::find($id);
    return view('tasks.edit', ['task' => $task]);
})->name('task-edit');

// Individual task pages:
Route::get('/tasks/{id}', function ( $id ) {
    $task = Task::find($id);
    return view('tasks.show', ['task' => $task]);
})->name('task-show');

// Protected pages
//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
