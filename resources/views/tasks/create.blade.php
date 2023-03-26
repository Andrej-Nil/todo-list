@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="top">
        <h1 class="main-title">Создание задачи</h1>
    </div>

    <div class="content">
        <form id="createTaskForm" class="form block" action="{{route('tasks.store')}}" method="POST">
            @csrf
            @include('tasks.form')
            <div class="form__bottom">
                <button class="btn btn_blue btn_small" type="submit">Создать</button>
            </div>

        </form>
    </div>
@endsection
