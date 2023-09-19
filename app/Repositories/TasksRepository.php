<?php

namespace App\Repositories;

use App\Enums\TasksStatusEnum;
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
        $task->update($data);
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    public function doesTaskHaveUncompletedSubtasks(int|array $parentTaskIds): bool
    {
        $parentTaskIds = is_array($parentTaskIds) ? $parentTaskIds : [$parentTaskIds];

        $subtasks = Task::select('id', 'status')
            ->whereIn('parent_task_id', $parentTaskIds)
            ->get(); 

        if ($subtasks->count() === 0) {
            return false;
        }

        // if task has any uncompleted subtask
        if ($subtasks->firstWhere('status', TasksStatusEnum::Todo)) {
            return true;
        } 
        
        return $this->doesTaskHaveUncompletedSubtasks($subtasks->pluck('id')->toArray());
    }
}
