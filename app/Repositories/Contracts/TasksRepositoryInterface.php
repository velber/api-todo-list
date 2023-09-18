<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Models\Task;

interface TasksRepositoryInterface
{
    public function create(User $user, array $data): Task;
}