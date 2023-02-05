@extends('layouts.app')


@section('content')
    <div class="top">
        <h1 class="main-title">Список задачь</h1>
        <a href="{{route('tasks.create')}}" class="btn btn_blue">Создать задачу</a>
    </div>

    <div class="search block">
        <input form="filter" class="search__input input" type="text" placeholder="Поиск" name="value">
        <button type="submit" form="filter" class="search-btn btn btn_blue">
            <i class="search-btn__icon"></i>
        </button>
    </div>
    <div class="content row-container">

        <div class="table block">
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
        <div class="sidebar block">
            <form id="filter" action="test" method="GET" class="form">
                @csrf
                <div class="form__inputs">
                    <div class="select">
                        <div class="select__top">
                            <p class="select__title">Сначало новые</p>
                            <i class="select__arrow"></i>
                        </div>
                        <div class="select__dropdown">
                            <ul class="select__list">
                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> От А да Я </span>
                                        <input class="checkbox__input" name="sorting" value="1" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> Сначало важные </span>
                                        <input class="checkbox__input" name="sorting" value="2" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> Сначало новые </span>
                                        <input class="checkbox__input" name="sorting" value="3" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> Сначало старые </span>
                                        <input class="checkbox__input" name="sorting" value="4" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="select">

                        <div class="select__top">
                            <p class="select__title"> Отображать: 10</p>
                            <i class="select__arrow"></i>
                        </div>
                        <div class="select__dropdown">
                            <ul class="select__list">
                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 20 </span>
                                        <input class="checkbox__input" name="sorting" value="1" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 40 </span>
                                        <input class="checkbox__input" name="sorting" value="2" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 60 </span>
                                        <input class="checkbox__input" name="sorting" value="3" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 100 </span>
                                        <input class="checkbox__input" name="sorting" value="4" type="radio"/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Важные
                        </span>
                        <input class="checkbox__input" type="checkbox"/>
                        <span class="checkbox__fake"></span>

                    </label>
                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Завершенные
                        </span>
                        <input class="checkbox__input" type="checkbox"/>
                        <span class="checkbox__fake"></span>

                    </label>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Свободные задачи
                        </span>
                        <input class="checkbox__input" type="checkbox"/>
                        <span class="checkbox__fake"></span>

                    </label>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            В работе
                        </span>
                        <input class="checkbox__input" type="checkbox"/>
                        <span class="checkbox__fake"></span>

                    </label>
                </div>
                <button class="form__submit btn btn_small btn_blue">Показать</button>

            </form>
        </div>
    </div>



@endsection
