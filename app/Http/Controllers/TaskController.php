<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        return view('tasks.index');
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(){

        return to_route('tasks.show', 5);
    }

    public function show() {
        return view('tasks.show');
    }

    public function edit($id) {
        return view('tasks.edit');
    }

    public function update($id) {
        return to_route('tasks.show', 5);
    }

    public function destroy($id) {
        return to_route('tasks.index');
    }
}
