<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface TasksRepositoryInterface
{
    public function create(): Model;
}