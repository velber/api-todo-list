<?php

use App\Enums\TasksStatusEnum;
use App\Enums\TasksPriorityEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedTinyInteger('priority')->default(TasksPriorityEnum::ONE->value);
            $table->string('status')->default(TasksStatusEnum::Todo->value);
            $table->unsignedBigInteger('parent_task_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('completedAt')->nullable();
            $table->timestamp('createdAt');

            // add foreign key constrains on users
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
