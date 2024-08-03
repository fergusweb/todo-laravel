<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    /**
     * Show the index of tasks
     *
     * @return View
     */
    public function index() {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->latest()->get();
        //$tasks = Task::latest()->get();
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form to Create Task
     *
     * @return View
     */
    public function create() {
        return view('tasks.create');
    }

    /**
     * Show a task
     *
     * @param Task $task
     * @return View
     */
    public function show(Task $task) {
        return view('tasks.show', ['task' => $task]);

    }

    /**
     * Create a task
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Show the form to edit a task
     *
     * @param Task $task
     * @return View
     */
    public function edit( Task $task ) {
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the task
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Delete the task
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Task $task ) {
        $task->delete();
        return redirect('/');
    }

}
