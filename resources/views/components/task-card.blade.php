<!-- resources/views/components/task-card.blade.php -->
@php
    // Load the task model based on the provided task ID
    $task = \App\Models\Task::find($taskid);
    $user = $task->user;
    $avatar = 'https://live.staticflickr.com/7369/8725121452_dfb9881fd9_b.jpg';

    $description = $task->description;
    $words = explode(' ', $description);
    $words = array_slice($words, 0, 14);
    $description = implode(' ', $words) . (count($words) < count(explode(' ', $description)) ? '...' : '');
@endphp


<div class="shadow-lg rounded-xl w-full p-4 bg-white relative overflow-hidden">
    <a href="/tasks/{{ $task->id }}" class="w-full h-full block">
        <div class="flex items-center border-b-2 mb-2 py-2">
            <img class='w-10 h-10 object-cover rounded-full' alt='User avatar' src='{{ $avatar }}'>

            <div class="pl-3">
                <div class="font-medium">
                    {{ $user->name }}
                </div>
                <div class="text-gray-600 text-xs">
                    {{ $user->email }}
                </div>
            </div>
        </div>

        <div class="w-full">
            <p class="text-gray-800 text-xl font-medium mb-2">
                {{ $task['name'] }}
            </p>
            <p class="text-gray-400 text-sm mb-4">
                {{ $description }}
            </p>
        </div>

        <?php
        /*
        <div class="w-full space-y-2">
            @foreach ($task['items'] as $item)
                <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                        <input
                            id="comments"
                            name="comments"
                            type="checkbox"
                            {{ $item->isCompleted() ? 'checked="checked"' : '' }}
                            disabled
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="text-sm leading-6">
                        <label for="comments" class="font-medium text-gray-900">{{ $item['name'] }}</label>
                        <!--
                            <p class="text-gray-400 text-sm">{{ $item['description'] }}</p>
                        -->
                    </div>
                </div>
            @endforeach
        </div>
        */
        ?>




        <div class="flex items-center justify-between my-2">
            <p class="text-gray-300 text-sm">
                {{ $task->countCompletedItems() }}/{{ $task->countItems() }} task completed
            </p>
        </div>
        <div class="w-full h-2 bg-blue-200 rounded-full">
            <div
                class="w-2/3 h-full text-center text-xs text-white bg-blue-600 rounded-full"
                style="width:{{ $task->percentComplete() }}%">
            </div>
        </div>
    </a>
</div>
