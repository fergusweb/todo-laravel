<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function index() {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->latest()->get();
        //$tasks = Task::latest()->get();
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }
    public function create() {
        return view('tasks.create');
    }
    public function show(Task $task) {
        return view('tasks.show', ['task' => $task]);

    }
    public function store() {
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
    }
    public function edit( Task $task ) {
        return view('tasks.edit', ['task' => $task]);
    }
    public function update( Task $task ) {
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
    }
    public function destroy( Task $task ) {
        $task->delete();
        return redirect('/');
    }

}
