<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


class TaskController extends Controller
{

    /**
     * Show the index of tasks
     *
     * @return View
     */
    public function index()
    {
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
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Show a task
     *
     * @param Task $task
     * @return View
     */
    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Create a task
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'taskName' => ['required', 'min:3' , 'max:255'],
            'taskDescription' => ['max:255'],
            'items.*.name' => ['required', 'min:3', 'max:255'],
            'items.*.description' => ['string', 'max:255'],
            'items.*.completed' => 'sometimes|boolean',
        ]);
        // Create our Task
        $task = Task::create([
            'name' => request('taskName'),
            'description' => request('taskDescription'),
            'user_id' => Auth::id(),
        ]);
        // Add TaskItems to Task
        foreach ($request->input('items') as $item) {
            $task->taskItems()->create([
                'name' => $item['name'],
                'description' => $item['description'],
                'completed_at' => isset($item['completed']) && $item['completed'] ? Carbon::now() : null,
            ]);
        };
        return redirect('/tasks/' . $task->id)->with('success', 'Task created successfully with items.');
    }

    /**
     * Show the form to edit a task
     *
     * @param Task $task
     * @return View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the task
     *
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task, Request $request)
    {
        $request->validate([
            'taskName' => ['required', 'min:3' , 'max:255'],
            'taskDescription' => ['max:255'],
            //'items.*.name' => ['required', 'min:3', 'max:255'],
            //'items.*.description' => ['string', 'max:255'],
            //'items.*.completed' => 'sometimes|boolean',
        ]);

        // Figure out which task items need to be deleted
        $existingTaskItemIds = $task->taskItems()->pluck('id')->toArray();
        $requestedTaskItemIds = array_filter(array_column($request->input('items'), 'task_id'));
        $taskItemsToDelete = array_diff($existingTaskItemIds, $requestedTaskItemIds);
        // Delete the ones we don't want.
        TaskItem::destroy($taskItemsToDelete);

        // Update the task details
        $task->update([
            'name' => request('taskName'),
            'description' => request('taskDescription'),
            'user_id' => Auth::id(),
        ]);
        // Update the TaskItems to Task
        foreach ($request->input('items') as $item) {
            if (isset($item['task_id'])) {
                $taskItem = TaskItem::find($item['task_id']);
                $taskItem->update([
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'completed_at' => isset($item['completed']) ? Carbon::now()->toDateTimeString() : null,
                ]);
            } else {
                $task->taskItems()->create([
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'completed_at' => isset($item['completed']) ? Carbon::now()->toDateTimeString() : null,
                ]);
            }
        };
        return redirect('/tasks/' . $task->id)->with('success', 'Task has been updated.');
    }

    /**
     * Delete the task
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task has been deleted.');
    }
}
