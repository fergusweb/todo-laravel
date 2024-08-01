<x-app-layout>
    <x-slot:title>
        Tasks - {{ $task['name'] }}
    </x-slot>

    <x-slot:header>
        {{ $task['name'] }}
    </x-slot:header>



    <h2 class="font-bold text-xl">{{ $task['name'] }}</h2>
    <p>
        {{ $task['description'] }}
    </p>

</x-app-layout>
