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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => TasksStatusEnum::class,
        'priority' => TasksPriorityEnum::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'parent_task_id',
        'createdAt',
    ];
}
