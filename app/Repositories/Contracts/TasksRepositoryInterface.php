<?php

namespace App\Repositories\Contracts;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;

interface TasksRepositoryInterface
{
    public function getTasksListQuery(
        User $user,
        SortAndFilterInterface $sortAndFilter
    ): QueryBuilder;

    public function create(User $user, array $data): Task;

    public function update(Task $task, array $data): void;

    public function delete(Task $task): void;

    public function doesTaskHaveUncompletedSubtasks(int|array $parentTaskIds): bool;
}
