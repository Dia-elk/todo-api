<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use HttpResponses;

    public function index()
    {
        $tasks = Task::query()->paginate();
        return TasksResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'creator_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);

        return new TasksResource($task);

    }

    public function show(Task $task)
    {

        return new TasksResource($task);
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TasksResource($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return $this->success('', 'The Task was deleted successfully');
    }
}
