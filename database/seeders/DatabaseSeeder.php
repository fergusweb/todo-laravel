<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskItem;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with users & tasks
     */
    public function run(): void
    {
        for ($i = 0; $i <= 5; $i++) {
            TaskItem::Factory()
                ->count(10)
                ->for(Task::factory())
                ->create();
        }
    }
}
