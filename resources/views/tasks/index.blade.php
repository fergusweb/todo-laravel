<x-app-layout>
    <x-slot:title>
        Tasks
    </x-slot>

    <x-slot:header>
        See Tasks
    </x-slot:header>

    <h2 class="text-xl mb-3">Let's show our tasks here</h2>


    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($tasks as $task)
            <x-task-card :taskid="$task->id" />
        @endforeach
    </div>

</x-app-layout>
