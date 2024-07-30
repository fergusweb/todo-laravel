<x-app-layout>
    <x-slot:title>
        Tasks - TODO TASK NAME
    </x-slot>

    <x-slot:header>
        TODO TASK NAME
    </x-slot:header>



    <h2 class="font-bold text-xl">{{ $task['name'] }}</h2>
    <p>
        {{ $task['description'] }}
    </p>

</x-app-layout>
