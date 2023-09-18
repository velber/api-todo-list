<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TasksRepositoryInterface
{
    public function getTasks(User $user): mixed;

    public function create(User $user, array $data): Task;
}