<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::where('is_publish', 1)->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create() {

        return view('tasks.create');
    }

    public function store(TaskRequest $request){
        $task = Task::create($request->validated());
        return to_route('tasks.show', $task);
    }

    public function show(Task $task) {
        $customer = User::find($task->customer);
        $executors = $task->users;
        return view('tasks.show', compact('task', 'customer', 'executors'));
    }

    public function edit($id) {
        return view('tasks.edit');
    }

    public function update($id) {
        return to_route('tasks.show', 5);
    }

    public function destroy($id) {
        Auth::logout();
        return to_route('login');
//
    }
}
