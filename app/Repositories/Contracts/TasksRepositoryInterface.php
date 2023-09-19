<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TasksRepositoryInterface
{
    public function getTasks(User $user): mixed;

    public function create(User $user, array $data): Task;

    public function update(Task $task, array $data): void;

    public function delete(Task $task): void;

    public function doesTaskHaveUncompletedSubtasks(int|array $parentTaskIds): bool;
}