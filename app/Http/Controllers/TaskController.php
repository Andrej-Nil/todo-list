<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        return view('tasks.index');
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(TaskRequest $request){

        $task = Task::create($request->validated());

        Auth::user()->tasks()->attach($task);

        return to_route('tasks.show', $task);
    }

    public function show(Task $task) {
        dd($task);
        return view('tasks.show');
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
