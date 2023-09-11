<?php

namespace App\Models;

use App\Enums\TasksPriorityEnum;
use App\Enums\TasksStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => TasksStatusEnum::class,
        'priority' => TasksPriorityEnum::class,
    ];
}
