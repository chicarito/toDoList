<?php

namespace Database\Seeders;

use App\Models\DetailTask;
use App\Models\Task;
use App\Models\TaskDetail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt(123),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'tasker',
            'username' => 'tasker',
            'password' => bcrypt(123),
            'role' => 'tasker',
        ]);
        User::create([
            'name' => 'worker',
            'username' => 'worker',
            'password' => bcrypt(123),
            'role' => 'worker',
        ]);

        Task::create([
            'title' => 'quest from tasker',
            'created_by' => 2,
            'assigned_to' => 3,
        ]);

        Task::create([
            'title' => 'task from worker',
            'created_by' => 3,
            'assigned_to' => 3,
        ]);

        TaskDetail::create([
            'task_id' => 1,
            'title' => 'detail quest from tasker',
        ]);

        TaskDetail::create([
            'task_id' => 2,
            'title' => 'detail task from worker',
        ]);
    }
}
