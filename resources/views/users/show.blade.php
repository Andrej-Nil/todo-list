@extends('layouts.app')


@section('content')

    <div class="top">
        <h1 class="main-title">Профиль</h1>

        <div class="top__controls">
            <a href="{{route('users.edit', 5)}}" class="btn btn_yellow btn_small">Редоктирование</a>
            <form action="{{route('users.destroy', 5)}}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn_small btn_red">Удалить</button>
            </form>
        </div>
    </div>

    <div class="content two-coll">
        <div class="user block">

            <div class="user__photo">
                <img src="{{asset('image/img/default-user.png')}}" alt="" class="user__image">

            </div>
            <div class="user__content">
                <p class="user__title">Николай лох!</p>
                <div class="user__info">
                    <p class="user__subtitle">Информация о задачах</p>
                    <ul class="user__list">
                        <li class="user__item">
                            <span class="user__label">Активные</span>
                            <span class="user__value">2</span>
                        </li>
                        <li class="user__item">
                            <span class="user__label">Завершенные</span>
                            <span class="user__value">2</span>
                        </li>
                        <li class="user__item">
                            <span class="user__label">Созданные(общий стек)</span>
                            <span class="user__value">2</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="user-tasks block">
            <div class="user-tasks__top">
                <div class="user-tasks__title">Список задач</div>
            </div>

            <div class="user-tasks__group">
                <p class="user-tasks__subtitle">Активные</p>
                <div class="table">
                    <div class="table__content">

                        <div class="table__row">
                            <div class="table__coll table__coll_name">
                                <a href="{{route('home')}}" class="table__link">
                                    Первая задача
                                </a>
                            </div>
                            <div class="table__coll">
                                <div claas="table-info">
                            <span class="table__btn btn ">
                            <i class="table__btn-icon table__btn-icon_description" title="Важное"></i>
                                <p class="table-info__desc">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid beatae culpa doloribus expedita, neque quidem sint unde ut vitae voluptas.
                                </p>
                        </span>
                                </div>

                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_yellow">
                                    <i class="table__btn-icon table__btn-icon_important" title="Важное"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_green">
                                    <i class="table__btn-icon table__btn-icon_clock" title="статус"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_blue">
                                    <i class="table__btn-icon table__btn-icon_edit" title="Редостировать"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_red">
                                    <i class="table__btn-icon table__btn-icon_delete" title="удалить"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="user-tasks__group">
                <p class="user-tasks__subtitle">Завершенные</p>
                <div class="table">
                    <div class="table__content">

                        <div class="table__row">
                            <div class="table__coll table__coll_name">
                                <a href="{{route('home')}}" class="table__link">
                                    Первая задача
                                </a>
                            </div>
                            <div class="table__coll">
                                <div claas="table-info">
                            <span class="table__btn btn ">
                            <i class="table__btn-icon table__btn-icon_description" title="Важное"></i>
                                <p class="table-info__desc">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid beatae culpa doloribus expedita, neque quidem sint unde ut vitae voluptas.
                                </p>
                        </span>
                                </div>

                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_yellow">
                                    <i class="table__btn-icon table__btn-icon_important" title="Важное"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_green">
                                    <i class="table__btn-icon table__btn-icon_clock" title="статус"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_blue">
                                    <i class="table__btn-icon table__btn-icon_edit" title="Редостировать"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_red">
                                    <i class="table__btn-icon table__btn-icon_delete" title="удалить"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="user-tasks__group">
                <p class="user-tasks__subtitle">Созданные(общий стек)</p>
                <div class="table">
                    <div class="table__content">

                        <div class="table__row">
                            <div class="table__coll table__coll_name">
                                <a href="{{route('home')}}" class="table__link">
                                    Первая задача
                                </a>
                            </div>
                            <div class="table__coll">
                                <div claas="table-info">
                            <span class="table__btn btn ">
                            <i class="table__btn-icon table__btn-icon_description" title="Важное"></i>
                                <p class="table-info__desc">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid beatae culpa doloribus expedita, neque quidem sint unde ut vitae voluptas.
                                </p>
                        </span>
                                </div>

                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_yellow">
                                    <i class="table__btn-icon table__btn-icon_important" title="Важное"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_green">
                                    <i class="table__btn-icon table__btn-icon_clock" title="статус"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_blue">
                                    <i class="table__btn-icon table__btn-icon_edit" title="Редостировать"></i>
                                </a>
                            </div>
                            <div class="table__coll">
                                <a href="{{route('home')}}" class="table__btn btn btn_red">
                                    <i class="table__btn-icon table__btn-icon_delete" title="удалить"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
