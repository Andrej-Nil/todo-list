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
        $tasks = Task::paginate(10);
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
//        $owner = $task->owner;
//        $executors = $task->users;


        return view('tasks.show', compact('task'));
    }

    public function edit($id) {
        return view('tasks.edit');
    }

    public function update($id) {
        return to_route('tasks.show', 5);
    }

    public function destroy(Task $task) {
        $userId = Auth::user()->id;
        if($userId == $task->customer){
            $task->delete();
            return to_route('tasks.index')->with('success', 'удалено');
        }

        return to_back('error', 'У вас нет прав удалять эту задачу');
//
    }


    public function accept(Task $task) {
        $userId = Auth::user()->id;

        if($task->is_publish){
            $users = $task->users;
            if(count($users)){
                return back()->with('error', 'ошибка исользования');
            }
        }else{
            if($task->customer !== $userId){
                return back()->with('error', 'ошибка публичность');
            }
        }
        $task->update(['status'=> 1]);
        $task->users()->attach(Auth::user());
        return back()->with('success', 'Принята');
    }

    public function pause(Task $task) {

        if($task->status == 0){
            return back()->with('error', 'Задача не выполняеться');
        }
        if($task->status == 1 ){
            $task->update(['status'=> 2]);
            return back()->with('success', 'Задача приостановлина');
        }
        if($task->status == 2){
            $task->update(['status'=> 1]);
            return back()->with('error', 'Выполенеие продолжено');
        }
        if($task->status == 3 ){
            return back()->with('error', 'Задача уже завершина');
        }

    }

    public function completed(Task $task) {
        if($task->status == 0){
            return back()->with('error', 'Задача не выполняеться');
        }
        if($task->status == 1 || $task->status == 2){
            $task->update(['status'=> 3]);
            return back()->with('success', 'Задача выполнена');
        }
        if($task->status == 3 ){
            return back()->with('error', 'Задача уже завершина');
        }
    }
}
