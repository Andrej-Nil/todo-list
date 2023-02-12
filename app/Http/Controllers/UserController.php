<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    public function show($id) {
        return view('users.show');
    }

    public function edit($id) {
        return view('users.edit');
    }

    public function update($id) {
        return to_route('users.show', 5);
    }

    public function destroy($id) {

//        return to_route('tasks.index');
    }

}
