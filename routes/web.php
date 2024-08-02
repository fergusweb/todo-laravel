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


// Create
Route::get('/tasks/create', function () {
    return view('tasks.create');
})->name('task-create');


// Show
Route::get('/tasks/{task}', function ( Task $task ) {
    return view('tasks.show', ['task' => $task]);
})->name('task-show');


// Store/Create
Route::post('/tasks', function() {
    request()->validate([
        'taskName' => ['required', 'min:3'],
        'taskDescription' => [],
    ]);

    $task = Task::create([
        'name' => request('taskName'),
        'description' => request('taskDescription'),
        'user_id' => 1, // TODO: Link to authenticated user id
    ]);
    // TODO the task items as well - not sure how yet.

    return redirect('/tasks/'.$task->id);
});


// Edit
Route::get('/tasks/{task}/edit', function ( Task $task ) {
    return view('tasks.edit', ['task' => $task]);
})->name('task-edit');



// Update
Route::patch('/tasks/{task}', function ( Task $task ) {
    // TODO: Authorise
    request()->validate([
        'taskName' => ['required', 'min:3'],
        'taskDescription' => [],
    ]);

    $task->update([
        'name' => request('taskName'),
        'description' => request('taskDescription'),
        //'user_id' => 1, // TODO: Link to authenticated user id
    ]);

    return redirect('/tasks/'.$task->id);
})->name('task-update');

// Destroy/Delete
Route::delete('/tasks/{task}', function ( Task $task ) {
    // TODO: Authorise
    $task->delete();
    return redirect('/');
})->name('task-delete');




Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
