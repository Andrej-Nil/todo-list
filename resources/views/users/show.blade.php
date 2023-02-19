@extends('layouts.app')


@section('content')

    <div class="top">
        <h1 class="main-title">Профиль</h1>
        @if($user->id == Auth::user()->id)
            <div class="top__controls">

                <a href="{{route('users.edit', $user->id)}}" class="btn btn_yellow btn_small">Редоктирование</a>
                <form action="{{route('users.destroy', $user->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn_small btn_red">Удалить</button>
                </form>
            </div>
        @endif
    </div>

    <div class="content two-coll">
        <div class="user block">

            <div class="user__photo">
                <img src="{{asset('image/img/default-user.png')}}" alt="" class="user__image">

            </div>
            <div class="user__content">
                <p class="user__title">{{$user->name}}</p>
                {{--                <div class="user__info">--}}
                {{--                    <p class="user__subtitle">Информация о задачах</p>--}}
                {{--                    <ul class="user__list">--}}
                {{--                        <li class="user__item">--}}
                {{--                            <span class="user__label">Активные</span>--}}
                {{--                            <span class="user__value">2</span>--}}
                {{--                        </li>--}}
                {{--                        <li class="user__item">--}}
                {{--                            <span class="user__label">Завершенные</span>--}}
                {{--                            <span class="user__value">2</span>--}}
                {{--                        </li>--}}
                {{--                        <li class="user__item">--}}
                {{--                            <span class="user__label">Созданные(общий стек)</span>--}}
                {{--                            <span class="user__value">2</span>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="user-tasks block">
            <div class="user-tasks__top">
                <div class="user-tasks__title">Список задач</div>
            </div>
            @forelse($tasks as $tasksGroup)
                <div class="user-tasks__group">
                    <p class="user-tasks__subtitle">{{$tasksGroup['name_group']}}</p>
                    <div class="table">
                        <div class="table__content">
                            @forelse($tasksGroup['tasks'] as $task)
                                @include('includes.table-task')
                            @empty
                                <div class="table__row table__row_empty">
                                    Нет задач
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            @empty
                Нет задач
            @endforelse
        </div>
    </div>
@endsection
