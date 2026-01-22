<?php

namespace App\Http\Controllers\Api;

use App\Enums\TasksStatusEnum;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\Contracts\TasksRepositoryInterface;
use App\Repositories\SortAndFilter;

class TaskController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct(protected TasksRepositoryInterface $tasksRepository)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortAndFilter = new SortAndFilter($request);
        $tasksListQuery = $this->tasksRepository->getTasksListQuery($request->user(), $sortAndFilter);

        return TaskResource::collection($tasksListQuery->paginate(25));
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->tasksRepository->create($request->user(), $request->validated());

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->tasksRepository->update($task, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $this->tasksRepository->delete($task);
    }

    public function complete(Task $task)
    {
        $this->tasksRepository->update($task, [
            'status' => TasksStatusEnum::Done,
            'completedAt' => now(),
        ]);
    }
}
