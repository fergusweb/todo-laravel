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
Route::get('/tasks/{id}', function ( $id ) {
    $task = Task::find($id);
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
    // Do the task items as well - not sure how yet.

    return redirect('/tasks/'.$task->id);
});


// Edit
Route::get('/tasks/{id}/edit', function ( $id ) {
    $task = Task::find($id);
    return view('tasks.edit', ['task' => $task]);
})->name('task-edit');



// Update
Route::patch('/tasks/{id}', function ( $id ) {
    request()->validate([
        'taskName' => ['required', 'min:3'],
        'taskDescription' => [],
    ]);

    // TODO: Authorise

    $task = Task::findOrFail($id);

    $task->update([
        'name' => request('taskName'),
        'description' => request('taskDescription'),
        //'user_id' => 1, // TODO: Link to authenticated user id
    ]);

    return redirect('/tasks/'.$task->id);
})->name('task-update');

// Destroy/Delete
Route::delete('/tasks/{id}', function ( $id ) {
    // TODO: Authorise
    Task::findOrFail($id)->delete();
    return redirect('/');
})->name('task-delete');




Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
