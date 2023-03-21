@extends('layouts.app')


@section('content')
    <div class="top">


        <h1 class="main-title">Задача</h1>

        @if(Auth::user()->id == $task->owner_id && $task->status != 3)
            <div data-top-controls class="top__controls">
                <a href="{{route('tasks.edit', $task->id)}}" class="btn btn_small btn_yellow">Редоктировать</a>

                <form action="{{route('tasks.destroy', $task->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn_small btn_red">Удалить</button>
                </form>
            </div>
        @endif

    </div>

    <div class="content">
        <div data-task="{{$task->id}}" class="task block">
            <div data-body class="task__body">
                <h2 class="task__title">
                    {{$task->title}}
                    {{$task->status == 3 ? '(выполнена)' : ''}}
                </h2>
                <div class="task__content">
                    <p class="task__description">{{$task->description}}</p>
                    <div class="task-info">
                        <ul class="task-info__list">
                            <li class="task-info__item">
                                <span class="task-info__label">Статус</span>
                                <span class="task-info__value">
                                {{$task->status_label}}
                            </span>
                            </li>
                            <li class="task-info__item">
                                <span class="task-info__label">Исполнитель</span>
                                <span class="task-info__value">
                                {{$task->user ? $task->user->name : 'Не назначин'}}
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
                                <span class="task-info__value">{{$task->delivery_date}}</span>
                            </li>

                            <li class="task-info__item">
                                <span class="task-info__label">Заказчик</span>
                                <a href="{{route('users.show', $task->owner->id)}}"
                                   class="task-info__value link">{{$task->owner->name}}</a>
                            </li>

                            <li class="task-info__item">
                                <span class="task-info__label">Доступ</span>
                                <span class="task-info__value">
                                {{$task->is_publish ? 'Публичная' : 'Приватная'}}
                            </span>
                            </li>


                            <li class="task-info__item">
                                <span class="task-info__label">Дата создания</span>
                                <span class="task-info__value">{{$task->created_date}}</span>
                            </li>
                        </ul>


                    </div>

                </div>


                <div class="task__controls">
                    @if($task->status == 0)
                        <button data-task-action="accept" class="btn btn_blue btn_small">Приянть задачу</button>
                    @elseif($task->status == 1)
                        <button data-task-action="pause" class="btn btn_yellow btn_small">Приостановить</button>
                        <button data-task-action="complete" class="btn btn_green btn_small">Выполнено</button>
                    @elseif($task->status == 2)
                        <button data-task-action="pause" class="btn btn_yellow btn_small">Продолжить</button>
                        <button data-task-action="complete" class="btn btn_green btn_small">Выполнено</button>
                    @endif
                </div>
            </div>
            <div data-spinner class="task__spinner">
                <div class="spinner">
                    <div class="spinner__cubes">
                        <span class="leaf1"></span>
                        <span class="leaf2"></span>
                        <span class="leaf3"></span>
                        <span class="leaf4"></span>
                    </div>
                </div>
            </div>
            <div data-message class="task-message block">
                <p  data-message-text class="task-message__text"></p>
                <button data-hide-message class="task-message__btn btn btn_small btn_red">OK</button>
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
