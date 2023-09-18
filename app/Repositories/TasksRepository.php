<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use App\Repositories\Contracts\TasksRepositoryInterface;

class TasksRepository implements TasksRepositoryInterface
{
    public function getTasks(User $user): mixed
    {
        return $user->tasks;
    }

    public function create(User $user, array $data): Task
    {
        return $user->tasks()->create(array_merge($data, [
            'createdAt' => now(),
        ]))
            ->refresh();
    }

    public function update(Task $task, array $data): void
    {
        $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority'],
            'parent_task_id' => $data['parent_task_id'],
        ]);
    }
}
