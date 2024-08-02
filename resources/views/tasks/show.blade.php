<x-app-layout>
    <x-slot:title>
        Tasks - {{ $task['name'] }}
    </x-slot>

    <x-slot:header>
        Task: {{ $task['name'] }}
        <a href="/tasks/{{ $task->id }}/edit" style="float:right;"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>
    </x-slot:header>



    <h2 class="font-bold text-xl">{{ $task->name }}</h2>
    <p>
        {{ $task->description }}
    </p>

    <h3 class="mt-6 font-bold text-large mb-3">Tasks</h3>
    <div class="w-full space-y-2">
        @foreach ($task->items as $item)
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
                    <label for="comments" class="font-medium text-gray-900">{{ $item->name }}</label>
                    <!--
                        <p class="text-gray-400 text-sm">{{ $item->description }}</p>
                    -->
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>
