<x-app-layout>
    <x-slot:title>
        Create Task
    </x-slot>

    <x-slot:header>
        Create a new task
    </x-slot:header>

    <form method="POST" action="/tasks">
        @csrf
        <!--
        @if ($errors->any())
<div class="mx-10">
                <ul>
                    @foreach ($errors->all() as $error)
<li class="text-red-500 italic">{{ $error }}</li>
@endforeach
                </ul>
            </div>
@endif
-->

        <div class="mb-4">
            <x-input-label for="taskName" value="Task Name" />
            <x-text-input id="taskName" name="taskName" type="text" />
        </div>
        <div class="mb-4">
            <x-input-label for="taskDescription" value="Task Description" />
            <x-textarea-input id="taskDescription" name="taskDescription"></x-textarea-input>
        </div>

        <fieldset id="taskItems">
            <legend class="text-lg font-medium text-gray-900 mb-4">Task Items</legend>


            <div class="task-item grid gap-8" style="grid-template-columns:min-content auto;">
                <div class="flex h-8 w-8 items-center">
                    <div class="pt-14 grid gap-y-4">
                        <input type="checkbox" id="completed" name="items[0][completed]"
                            class="h-8 w-8 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <button type="button"
                            class="remove-item bg-red-600 text-white py-2 px-2 rounded-md shadow-sm hover:bg-red-700">X</button>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="mb-4">
                        <x-input-label for="itemName0" value="Item Name" />
                        <x-text-input id="taskName0" name="items[0][name]" type="text" required />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="itemDescription0" value="Item Description" />
                        <x-textarea-input id="itemDescription0" name="items[0][description]"
                            rows="2"></x-textarea-input>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="mt-6 mb-12">
            <x-secondary-button type="button" id="addItem">+ Add Item</x-secondary-button>
            <x-primary-button type="submit">+ Save Task</x-primary-button>
        </div>

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

    </form>

</x-app-layout>
