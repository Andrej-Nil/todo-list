@extends('layouts.app')

@section('content')
    <div class="top">
        <h1 class="main-title">Пользователи</h1>
    </div>

    <form class="search block" action="">
        <input form="filter" class="search__input input" type="text" placeholder="Поиск" name="value">
        <button type="submit" form="filter" class="search-btn btn btn_blue">
            <i class="search-btn__icon"></i>
        </button>
    </form>

    <div class="content">
        <div class="user-list">
            <div class="user-card block">
                <a href="{{route('users.show', 5)}}" class="user-card__link">
                    <div class="user-card__inner">
                        <div class="user-card__photo">
                            <img class="user-card__img" src="{{asset('image/img/default-user.png')}}"/>
                        </div>


                        <div class="user-card__content">
                            <p class="user-card__title">Николай Php</p>

                            <div class="user-card__info">
                                <p class="user-card__subtitle">Информация о задачах</p>
                                <ul class="user-card__list">
                                    <li class="user-card__item">
                                        <span class="user-card__label">Активные</span>
                                        <span class="user-card__value">2</span>
                                    </li>
                                    <li class="user-card__item">
                                        <span class="user-card__label">Завершенные</span>
                                        <span class="user-card__value">2</span>
                                    </li>
                                    <li class="user-card__item">
                                        <span class="user-card__label">Созданные(общий стек)</span>
                                        <span class="user-card__value">2</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="user-card block">
                <a href="{{route('users.show', 5)}}" class="user-card__link">
                    <div class="user-card__inner">
                        <div class="user-card__photo">
                            <img class="user-card__img" src="{{asset('image/img/default-user.png')}}"/>
                        </div>


                        <div class="user-card__content">
                            <p class="user-card__title">Рандомное имя</p>


                            <div class="user-card__info">
                                <p class="user-card__subtitle">Информация о задачах</p>
                                <ul class="user-card__list">
                                    <li class="user-card__item">
                                        <span class="user-card__label">Активные</span>
                                        <span class="user-card__value">2</span>
                                    </li>
                                    <li class="user-card__item">
                                        <span class="user-card__label">Завершенные</span>
                                        <span class="user-card__value">2</span>
                                    </li>
                                    <li class="user-card__item">
                                        <span class="user-card__label">Созданные(общий стек)</span>
                                        <span class="user-card__value">2</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
