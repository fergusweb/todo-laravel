<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\TaskItem;

class ShowTaskItem extends Component
{

    public $id;
    public $name;
    public $description;
    public $completed_at;
    public $completed;
    public $item;

    public function mount($item) {
        $this->item = $item;
        $this->id = $item->id;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->completed_at = $item->completed_at;
        $this->completed = $item->isCompleted();
    }

    public function render()
    {
        return view('livewire.tasks.show-task-item');
    }

    public function toggleCompleted() {
        if ($this->completed) {
            $this->completed = false;
            $this->item->completed_at = null;
            $this->item->save();
        } else {
            $this->completed = true;
            $this->item->complete();
        }
        /*
        $this->completed = ($this->completed) ? false : true;
        $this->item->complete();
        $this->item->save();
        */
    }
}
