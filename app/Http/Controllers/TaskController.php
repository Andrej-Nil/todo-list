<?php

namespace App\Http\Controllers;

use App\Helpers\StatusHelper;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 20);
        $tasks = Task::filter($request)->sort($request)->paginate($limit);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {

        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        $request['owner_id'] = Auth::user()->id;
        if ($request->status) {
            $request['executor_id'] = Auth::user()->id;
        }
        $task = Task::create($request->all());
        return to_route('tasks.show', $task);
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return to_route('tasks.show', $task);
    }

    public function destroy(Task $task)
    {
        $userId = Auth::user()->id;
        if ($userId == $task->owner_id) {
            $task->delete();
            return to_route('tasks.index')->with('success', 'удалено');
        }

        return back()->with('error', 'У вас нет прав удалять эту задачу');
    }

}
