<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function accept(Task $task)
    {
        $userId = Auth::user()->id;
        if($task->executor_id){
            return ResponseHelper::getError('У этой задачи уже назначин исполнитель', 409);
        }
        if($task->status === 3){
            return ResponseHelper::getError('Эта задача уже выполнена', 409);
        }

        if(!$task->is_publish && $task->owner_id !== $userId){
            return ResponseHelper::getError('Ошибка доступа', 423);
        }

        $task->update([
            'executor_id'=>$userId,
            'status'=>1
        ]);
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

    public function pause(Task $task){
        $userId = Auth::user()->id;
        $ifCompleted = 'Эту задачу нельзя приостоноваить/возобновить, так как она уже выполнена';
        $ifWithoutExecutor = 'Эту задачу нельзя приостоноваить/возобновить, так как она еще не выполняеться';
        if($task->status === 3){
            return ResponseHelper::getError($ifCompleted, 409);
        }
        if($task->status === 0){
            return ResponseHelper::getError($ifWithoutExecutor, 409);
        }
        if(!$task->is_publish && $task->owner_id !== $userId){
            return ResponseHelper::getError('Ошибка доступа', 423);
        }
        $status = $task->status == 1 ? 2 : 1;
        $task->update(['status'=>$status]);

        return new TaskResource($task);
    }

    public function complete(Task $task) {
        $userId = Auth::user()->id;
        if($task->status === 0){
            return ResponseHelper::getError("Эта задача еще не выполняеться", 409);
        }

        if($task->executor_id !== $userId) {
            return ResponseHelper::getError("Вы не являетесь исполнителем этой задачи", 409);
        }
        if(!$task->is_publish && $task->owner_id !== $userId){
            return ResponseHelper::getError('Ошибка доступа', 423);
        }

        $task->update(['status'=>3]);
        return new TaskResource($task);
    }

}
