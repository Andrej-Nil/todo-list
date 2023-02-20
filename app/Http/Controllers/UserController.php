<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $userId = $user->id;
        $tasksQuery = Task::where('owner_id', $userId)
            ->orWhereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        if (Auth::user()->id !== $userId) {
            $tasksQuery->where('is_publish', 1);
        }
        $tasksList = $tasksQuery->get();

        $tasks = [
            [
                'name_group' => 'Активные',
                'tasks' => $tasksList->whereIn('status', [1, 2])
            ],
            [
                'name_group' => 'Завершонные',
                'tasks' => $tasksList->where('status', 3)
            ],
            [
                'name_group' => 'Созданные задачи',
                'tasks' => $tasksList->where('owner_id', $userId)
            ],
        ];
        return view('users.show', compact('tasks', 'user'));
    }

    public function edit($id)
    {
        return view('users.edit');
    }

    public function update($id)
    {
        return to_route('users.show', 5);
    }

    public function destroy($id)
    {

//        return to_route('tasks.index');
    }

}
