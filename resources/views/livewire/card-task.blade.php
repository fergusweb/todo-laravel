<?php

use Livewire\Volt\Component;
use App\Models\Task;
use App\Models\TaskItem;

new class extends Component {
    public $task = false;

    public $avatar = 'https://live.staticflickr.com/7369/8725121452_dfb9881fd9_b.jpg';
};
?>

<div class="card">
    {{ $task }}
    <h2>{{ $task->name }}</h2>
    <p>{{ $task->description }}</p>
</div>

<div class="flex flex-wrap zplace-items-center zh-screen mb-5">
    <!-- card -->
    <div class="shadow-lg rounded-xl w-72 md:w-96 p-4 bg-white relative overflow-hidden">
        <a href="#" class="w-full h-full block">
            <div class="flex items-center border-b-2 mb-2 py-2">
                <img class='w-10 h-10 object-cover rounded-full' alt='User avatar' src='{{ $avatar }}'>

                <div class="pl-3">
                    <div class="font-medium">
                        {{ $user_name }}
                    </div>
                    <div class="text-gray-600 text-sm">
                        {{ $user_title }}
                    </div>
                </div>
            </div>
            <div class="w-full">
                <p class="text-gray-800 text-sm font-medium mb-2">
                    Working On:
                </p>
                <p class="text-gray-800 text-xl font-medium mb-2">
                    Improve css design of the carousel
                </p>
                <p class="text-blue-600 text-xs font-medium mb-2">
                    Due: Sunday, 23 August
                </p>
                <p class="text-gray-400 text-sm mb-4">
                    You've been coding for a while now and know your way around...
                </p>
            </div>
            <div class="flex items-center justify-between my-2">
                <p class="text-gray-300 text-sm">
                    4/6 task completed
                </p>
            </div>
            <div class="w-full h-2 bg-blue-200 rounded-full">
                <div class="w-2/3 h-full text-center text-xs text-white bg-blue-600 rounded-full">
                </div>
            </div>
        </a>
    </div>
</div>
