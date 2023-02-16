<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request) {

        $userId = Auth::user()->id;


        $tasks = Task::filter($request)->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create() {

        return view('tasks.create');
    }

    public function store(TaskRequest $request){
        $request['owner_id'] = Auth::user()->id;
        $task = Task::create($request->all());
        return to_route('tasks.show', $task);
    }

    public function show(Task $task) {

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, Task $task) {
        $task->update($request->all());
        return to_route('tasks.show', $task);
    }

    public function destroy(Task $task) {
        $userId = Auth::user()->id;
        if($userId == $task->owner_id){
            $task->delete();
            return to_route('tasks.index')->with('success', 'удалено');
        }

        return back()->with('error', 'У вас нет прав удалять эту задачу');
//
    }


    public function accept(Request $request) {
        $userId = Auth::user()->id;
        $taskId = $request->id;
        $task = Task::find($taskId);
            if(!$task){
                return [
                    'нет такой задачи'
                ];
            }
        if($task->is_publish){
            $users = $task->users;
            if(count($users)){
                return [
                    'publish'
                ];
//                return back()->with('error', 'ошибка исользования');
            }
        }else{
            if($task->owner_id !== $userId){
                return [
                    'owner'
                ];
//                return back()->with('error', 'ошибка публичность');
            }
        }
        $task->update(['status'=> 1]);
        $task->users()->attach(Auth::user());
        return [
            'data'=>['type'=>'success']
        ];
//        return back()->with('success', 'Принята');
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
