<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use App\Repositories\Contracts\TasksRepositoryInterface;

class TasksRepository implements TasksRepositoryInterface
{
    public function create(User $user, array $data): Task
    {
        return $user->tasks()->create(array_merge($data, [
            'createdAt' => now(),
        ]))
            ->refresh();
    }
}
