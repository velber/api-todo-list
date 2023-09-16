<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Contracts\TasksRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TasksRepository implements TasksRepositoryInterface
{
    public function create(): Model
    {
        // create Task

        return new Task();
    }
}