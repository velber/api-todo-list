<?php

namespace Database\Factories;

use App\Enums\TasksPriorityEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::random(10),
            'description' => Str::random(50),
            'priority' => collect(TasksPriorityEnum::cases())->random()->value,
            'parent_task_id' => null,
            'createdAt' => now(),
        ];
    }
}
