<?php

namespace App\Models;

use App\Models\User;
use App\Enums\TasksStatusEnum;
use App\Enums\TasksPriorityEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'status',
        'parent_task_id',
        'createdAt',
        'completedAt',
    ];

    public function isCompleted(): bool
    {
        return $this->status === TasksStatusEnum::Done;
    }

    public function isDeletable(): bool
    {
        return !$this->isCompleted();
    }

    public function isUserOwner(User $user): bool
    {
        return $user->id === $this->user_id;
    }
}
