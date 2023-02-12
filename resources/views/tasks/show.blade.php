@extends('layouts.app')


@section('content')
    <div class="top">
        <h1 class="main-title">{{$task->title}}</h1>
        <div class="top__controls">
            <a href="{{route('tasks.edit', $task->id)}}" class="btn btn_small btn_yellow">Редостировать</a>

            <form action="{{route('tasks.destroy', $task->id)}}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn_small btn_red">Удалить</button>
            </form>
        </div>
    </div>

    <div class="content">
        <div class="task block">
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
                                @forelse($executors as $executor)
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
                            <a href="{{route('users.show', $customer->id)}}" class="task-info__value link">{{$customer->name}}</a>
                        </li>

                    </ul>
                </div>

            </div>


        </div>
    </div>
@endsection
