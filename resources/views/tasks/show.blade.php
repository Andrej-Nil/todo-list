@extends('layouts.app')


@section('content')
    <div class="top">


        <h1 class="main-title">
            {{$task->title}}
            {{$task->status == 3 ? '(выполнена)' : ''}}
        </h1>

        @if(Auth::user()->id == $task->owner_id)
            <div class="top__controls">
                <a href="{{route('tasks.edit', $task->id)}}" class="btn btn_small btn_yellow">Редостировать</a>

                <form action="{{route('tasks.destroy', $task->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn_small btn_red">Удалить</button>
                </form>
            </div>
        @endif

    </div>

    <div class="content">
        <div data-task-id="{{$task->id}}" class="task block">
            <div class="task__content">
                <p class="task__description">{{$task->description}}</p>
                <div class="task-info">
                    <ul class="task-info__list">
                        <li class="task-info__item">
                            <span class="task-info__label">Статус</span>
                            <span class="task-info__value">
                                @if($task->status == 1)
                                    В работе
                                @elseif($task->status == 2)
                                    Приостановлина
                                @elseif($task->status == 3)
                                    Исполнена
                                @else
                                    В ожидании
                                @endif

                            </span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Доступ</span>
                            <span class="task-info__value">
                                {{$task->is_publish ? 'Публичная' : 'Приватная'}}
                            </span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Исполнитель</span>
                            <span class="task-info__value">
                                @forelse($task->users as $executor)
                                    {{$executor->name}}
                                @empty
                                    Не назначин
                                @endforelse
                            </span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Срочное</span>
                            <span class="task-info__value">
                                {{$task->is_urgent ? 'Да' : 'Нет'}}
                            </span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Важное</span>
                            <span class="task-info__value">
                                 {{$task->is_important ? 'Да' : 'Нет'}}
                            </span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Срок иполнения</span>
                            <span class="task-info__value">{{$task->date_of_delivery}}</span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Заказчик</span>
                            <a href="{{route('users.show', $task->owner->id)}}"
                               class="task-info__value link">{{$task->owner->name}}</a>
                        </li>
                    </ul>


                </div>

            </div>


            <div class="task__controls">

                @if($task->status == 0)
                    <button data-assept class="btn btn_blue btn_small">Приянть задачу</button>
                @elseif($task->status == 1)
                    <button data-pause class="btn btn_yellow btn_small">Приостановить</button>
                    <button data-complite class="btn btn_green btn_small">Выполнено</button>
                @elseif($task->status == 2)
                    <button data-pause class="btn btn_yellow btn_small">Продолжить</button>
                    <button data-complite class="btn btn_green btn_small">Выполнено</button>
                @endif

{{--                @if($task->status == 0)--}}

{{--                    <form class="task__form" action="{{route('tasks.accept', $task)}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('put')--}}
{{--                        <button type="submit" class="btn btn_blue btn_small">Приянть задачу</button>--}}
{{--                    </form>--}}

{{--                @elseif($task->status == 1)--}}
{{--                    <form class="task__form" action="{{route('tasks.pause', $task)}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('put')--}}
{{--                        <button type="submit" class="btn btn_yellow btn_small">Приостановить</button>--}}
{{--                    </form>--}}
{{--                    <form class="task__form" action="{{route('tasks.completed', $task)}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('put')--}}
{{--                        <button type="submit" class="btn btn_green btn_small">Выполнено</button>--}}
{{--                    </form>--}}

{{--                @elseif($task->status == 2)--}}
{{--                    <form class="task__form" action="{{route('tasks.pause', $task)}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('put')--}}
{{--                        <button type="submit" class="btn btn_yellow btn_small">Продолжить</button>--}}
{{--                    </form>--}}
{{--                    <form class="task__form" action="{{route('tasks.completed', $task)}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('put')--}}
{{--                        <button type="submit" class="btn btn_green btn_small">Выполнено</button>--}}
{{--                    </form>--}}
{{--                @endif--}}

            </div>
        </div>
    </div>
{{--        @if (Session::has($error ?? 'error'))--}}
{{--            <div class="alert alert-danger">--}}
{{--                <p style="margin-bottom: 0;">{{ Session::get($error ?? 'error') }}</p>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if (Session::has($success ?? 'success'))--}}
{{--            <div class="alert alert-success">--}}
{{--                <p style="margin-bottom: 0;">{{ Session::get($success ?? 'success') }}</p>--}}
{{--            </div>--}}
{{--    @endif--}}
@endsection
