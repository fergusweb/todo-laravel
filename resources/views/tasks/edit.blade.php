<x-app-layout>
    <x-slot:title>
        Edit Task: {{ $task->name }}
    </x-slot>

    <x-slot:header>
        Edit Task: {{ $task->name }}
    </x-slot:header>

    <form method="POST" action="/tasks/{{ $task->id }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <x-input-label for="taskName" value="Task Name" />
            <x-text-input id="taskName" name="taskName" type="text" value="{{ $task->name }}" required />
            <x-input-error :messages="$errors->get('taskName')" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-input-label for="taskDescription" value="Task Description" />
            <x-textarea-input id="taskDescription" name="taskDescription">{{ $task->description }}</x-textarea-input>
            <x-input-error :messages="$errors->get('taskDescription')" class="mt-2" />
        </div>

        <fieldset id="taskItems">
            <legend class="text-lg font-medium text-gray-900 mb-4">Task Items</legend>
            @php
                // So that we'll show an empty task item at the bottom of the form, if none are set.
                if (!is_array($task->items) || empty($task->items)) {
                    $task->items[] = new App\Models\TaskItem();
                }
            @endphp
            @foreach ($task->items as $item)
                <input type="hidden" name="items[{{ $loop->index }}][task_id]" value="{{ $item->id }}">
                <div class="task-item grid gap-8" style="grid-template-columns:min-content auto;">
                    <div class="flex h-8 w-8 items-center">
                        <div class="pt-14 grid gap-y-4">
                            <input type="checkbox" id="completed" name="items[{{ $loop->index }}][completed]"
                                {{ $item->isCompleted() ? 'checked' : '' }}
                                class="h-8 w-8 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <button type="button"
                                class="remove-item bg-red-600 text-white py-2 px-2 rounded-md shadow-sm hover:bg-red-700">X</button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="mb-4">
                            <x-input-label for="itemName{{ $loop->index }}" value="Item Name" />
                            <x-text-input id="taskName{{ $loop->index }}" name="items[{{ $loop->index }}][name]"
                                type="text"
                                value="{{ $item->name }}" />
                            <x-input-error :messages="$errors->get('items[{{ $loop->index }}][name]')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="itemDescription{{ $loop->index }}" value="Item Description" />
                            <x-textarea-input id="itemDescription{{ $loop->index }}"
                                name="items[{{ $loop->index }}][description]"
                                rows="2">{{ $item->description }}</x-textarea-input>
                            <x-input-error :messages="$errors->get('items[{{ $loop->index }}][description]')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endforeach
        </fieldset>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div>
                <x-secondary-button type="button" id="addItem">+ Add Item</x-secondary-button>
                <x-primary-button type="submit">Save Task</x-primary-button>
            </div>
            <div>
                <x-delete-button type="submit" form="delete-form">Delete</x-primary-button>
            </div>
        </div>

    </form>

    <form id="delete-form" method="POST" action="/tasks/{{ $task->id }}" class="hidden">
        @csrf;
        @method('DELETE')
    </form>

</x-app-layout>

<script>
    // Keep track of how many items we have to start with.
    let itemIndex = document.querySelectorAll('#taskItems .task-item').length;

    document.getElementById('addItem').addEventListener('click', function() {
        const taskItems = document.getElementById('taskItems');
        // Clone a new item node
        const newItem = taskItems.querySelector('.task-item').cloneNode(true);
        // Clear existing values
        newItem.querySelectorAll('input, textarea').forEach(input => input.value = '');
        newItem.querySelectorAll('input[type=checkbox]').forEach(input => input.checked = false);
        // Update names for items to have proper indexes
        newItem.querySelectorAll('input, textarea').forEach(input => {
            const name = input.getAttribute('name');
            if (name.includes('[completed]')) {
                input.setAttribute('name', `items[${itemIndex}][completed])`);
            }
            if (name.includes('[name]')) {
                input.setAttribute('name', `items[${itemIndex}][name])`);
                input.setAttribute('id', 'itemName' + itemIndex);
                input.parentElement.querySelector('label').setAttribute('for', 'itemName' + itemIndex);
            }
            if (name.includes('[description]')) {
                input.setAttribute('name', `items[${itemIndex}][description])`);
                input.setAttribute('id', 'itemDescription' + itemIndex);
                input.parentElement.querySelector('label').setAttribute('for', 'itemDescription' +
                    itemIndex);
            }
        });
        taskItems.appendChild(newItem);
        itemIndex++;
    });

    document.getElementById('taskItems').addEventListener('click', function(e) {
        const taskItems = document.querySelectorAll('.task-item');
        if (e.target.classList.contains('remove-item') && taskItems.length > 1) {
            e.target.closest('.task-item').remove();
        }
    });
</script>


<style>
    #taskItems .task-item:first-of-type .remove-item {
        display: none;
    }
</style>
