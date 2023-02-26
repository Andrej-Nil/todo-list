<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Resources\TaskResource;
use \App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
//    Route::post('/tasks/{task}', [TaskController::class, 'showInfo'] )->name('tasks.showInfo');
    Route::post('/tasks/{task}', function ($task){
        return new TaskResource(Task::findOrFail($task));
    });


    Route::put('/tasks/accept', [TaskController::class, 'accept'] )->name('tasks.accept');
    Route::put('/tasks/{task}/pause', [TaskController::class, 'pause'] )->name('tasks.pause');
    Route::put('/tasks/{task}/completed', [TaskController::class, 'completed'] )->name('tasks.completed');

    Route::resource('/tasks', TaskController::class);

//    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
//    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
//    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
//    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
//    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
//    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
//    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [TaskController::class, 'destroy'])->name('users.destroy');
});




//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
