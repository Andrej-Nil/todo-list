<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function accept(Task $task)
    {
//        $userId = Auth::user()->id;
        if($task->executor_id){
            return [
                'status'=>'error',
                'data'=>[
                    'message'=>'Исполнитель назначен'
                ]
            ];
        }

        return new TaskResource($task);
//        if ($task->is_publish) {
//            $users = $task->users;
//            if (count($users)) {
//                return [
//                    'publish'
//                ];
//                return back()->with('error', 'ошибка исользования');
//            }
//        } else {
//            if ($task->owner_id !== $userId) {
//                return [
//                    'owner'
//                ];
//                return back()->with('error', 'ошибка публичность');
//            }
//        }
//        $task->update(['status' => 1]);
//        $task->users()->attach(Auth::user());
//        return [
//            'data' => ['type' => 'success']
//        ];
//        return back()->with('success', 'Принята');
    }

}
