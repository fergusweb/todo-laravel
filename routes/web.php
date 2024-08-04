<?php

use App\Models\Task;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Register alias:
//'TaskController' => App\Http\Controllers\TaskController::class;

// General pages
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

//Route::view('/', 'guests')
//    ->name('home');


// Homepage is a guest view if not logged in, otherwise it shows your tasks
Route::get('/', function() {
        if (auth()->check()) {
            return app(TaskController::class)->index();
            /*
            //return TaskController::index();
            $user = auth()->user();
            $tasks = Task::where('user_id', $user->id)->get();
            return view('tasks.index', ['tasks' => $tasks]);
            */
        } else {
            return view('guests');
        }
    })
    ->name('home');


// Task routing
Route::controller(TaskController::class)->group(function() {
    Route::get('/tasks', 'index')
        ->middleware('auth')
        ->name('tasks.index');

    Route::get('/tasks/create', 'create')
        ->middleware('auth')
        ->name('tasks.create');

    Route::get('/tasks/{task}', 'show')
        ->middleware('auth')
        ->can('view', 'task');

    Route::get('/tasks/{task}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'task');

    Route::post('/tasks', 'store')
        ->middleware('auth');

    Route::patch('/tasks/{task}', 'update')
        ->middleware('auth')
        ->can('edit', 'task');

    Route::delete('/tasks/{task}', 'destroy')
        ->middleware('auth')
        ->can('edit', 'task');
});
//Route::resource('tasks', TaskController::class);



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
