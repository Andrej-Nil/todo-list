<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
//            $user_id = Auth::user()->id;
//            $tasks = Task::whereHas('users', function($query) use($user_id){
//                $query->where('user_id', $user_id );
//            })->orWhere('customer', $user_id )->get();
//            return view('home', compact('tasks'));

            return to_route('tasks.index');
        }else{
            return view('landing');
        }
    }
}
