@extends('layouts.app')

@section('content')
    <div class="top">
        <h1 class="main-title">Редостирование задачи</h1>
    </div>

    <div class="content">
        <form class="form block" action="{{route('tasks.update', $task)}}" method="POST">
            @csrf
            @method('PUT')
          @include('tasks.form')

            <div class="form__bottom">
                <button class="btn btn_blue btn_small" type="submit">Сохранить</button>
            </div>

        </form>
    </div>
@endsection
