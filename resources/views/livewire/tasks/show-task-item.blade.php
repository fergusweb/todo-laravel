<div class="relative flex gap-x-3 @if($completed) line-through @endif">
    <div class="flex h-6 items-center">
        <input id="completed{{ $id }}" name="completed" type="checkbox"
            {{ $completed ? 'checked="checked"' : '' }}
            wire:click="toggleCompleted"
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
    </div>
    <div class="text-sm leading-6">
        <label for="completed{{ $id }}" class="font-medium text-gray-900">{{ $name }}</label>
        <p class="text-gray-500 text-sm">{{ $description }}</p>
    </div>
</div>
