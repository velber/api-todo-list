<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Repositories\Contracts\TasksRepositoryInterface;

class TaskPolicy
{
    /**
     * Constructor.
     */
    public function __construct(protected TasksRepositoryInterface $tasksRepository)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return $task->isUserOwner($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $this->update($user, $task) && !$task->isCompleted();
    }

    /**
     * Determine whether the user can complete the task.
     */
    public function complete(User $user, Task $task): bool
    {
        return $this->update($user, $task)
            && !$this->tasksRepository->doesTaskHaveUncompletedSubtasks($task->id);
    }
}
