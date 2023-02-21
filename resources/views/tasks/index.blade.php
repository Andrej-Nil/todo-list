@extends('layouts.app')


@section('content')
    <div class="top">
        <h1 class="main-title">Список задачь</h1>
        <a href="{{route('tasks.create')}}" class="btn btn_blue">Создать задачу</a>
    </div>

    <div class="search block">
        <input form="filter" class="search__input input" type="text" placeholder="Поиск"
               value="{{$_GET['search'] ?? ''}}" name="search">
        <button type="submit" form="filter" class="search-btn btn btn_blue">
            <i class="search-btn__icon"></i>
        </button>
    </div>
    <div class="content row-container">

        <div class="table block">

            <div class="table__content">
                @forelse($tasks as $task)
                    @include('includes.table-task')
                @empty
                    <div class="table-message">
                        <p class="table-message__title">В стоке пока нет задач.</p>
                        <p class="table-message__text">
                            Вы можете создать <a href="{{route('tasks.create')}}" class="link">задачу</a> добавив ее в
                            сток
                        </p>
                    </div>
                @endforelse

            </div>
        </div>
        <div class="sidebar block">
            <form id="filter" action="{{route('tasks.index')}}" method="GET" class="form">
                @csrf
                <div class="form__inputs">
                    <div data-select="close" class="select">
                        <div data-select-btn class="select__top">
                            <p data-select-title class="select__title">Сначала новые</p>
                            <i class="select__arrow"></i>
                        </div>
                        <div data-dropdown class="select__dropdown">
                            <ul class="select__list">
                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> Сначала новые </span>
                                        <input class="checkbox__input" data-label="Сначала новые" name="sorting" value="new"
                                               type="radio" @checked(!empty($_GET['sorting']) ? ($_GET['sorting'] == 'new') : 1)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>
                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> Сначала важные </span>
                                        <input class="checkbox__input" data-label="Сначало важные" name="sorting" value="important"
                                               type="radio" @checked(!empty($_GET['sorting']) ? ($_GET['sorting'] == 'important') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>


                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> Сначала срочные</span>
                                        <input class="checkbox__input" data-label="Сначала срочные" name="sorting" value="urgent"
                                               type="radio" @checked(!empty($_GET['sorting']) ? ($_GET['sorting'] == 'urgent') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> От А да Я </span>
                                        <input class="checkbox__input" data-label="От А да Я" name="sorting" value="abc"
                                               type="radio" @checked(!empty($_GET['sorting']) ? ($_GET['sorting'] == 'abc') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> По дате </span>
                                        <input class="checkbox__input" data-label="По дате" name="sorting" value="data"
                                               type="radio" @checked(!empty($_GET['sorting']) ? ($_GET['sorting'] == 'data') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>


                            </ul>
                        </div>
                    </div>

                    <div data-select="close" class="select">

                        <div data-select-btn class="select__top">
                            <p data-select-title class="select__title"> Отображать: 20</p>
                            <i class="select__arrow"></i>
                        </div>
                        <div data-dropdown class="select__dropdown">
                            <ul class="select__list">
                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 20 </span>
                                        <input class="checkbox__input" data-label="Отображать: 20" name="limit" value="20"
                                               type="radio" @checked(!empty($_GET['limit']) ? ($_GET['limit'] == '20') : 1)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 40 </span>
                                        <input class="checkbox__input" data-label="Отображать: 40" name="limit" value="40"
                                               type="radio" @checked(!empty($_GET['limit']) ? ($_GET['limit'] == '40') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 60 </span>
                                        <input class="checkbox__input" data-label="Отображать: 60" name="limit" value="60"
                                               type="radio" @checked(!empty($_GET['limit']) ? ($_GET['limit'] == '60') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> 100 </span>
                                        <input class="checkbox__input" data-label="Отображать: 100" name="limit" value="100"
                                               type="radio" @checked(!empty($_GET['limit']) ? ($_GET['limit'] == '100') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div data-select="close" class="select">

                        <div data-select-btn class="select__top">
                            <p data-select-title class="select__title"> Все </p>
                            <i class="select__arrow"></i>
                        </div>
                        <div data-dropdown class="select__dropdown">
                            <ul class="select__list">

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title">Все</span>
                                        <input class="checkbox__input" data-label="Все" name="area" value="stack"
                                               type="radio" @checked(!empty($_GET['area']) ? ($_GET['area'] == 'stack') : 1)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title">Мои задачи</span>
                                        <input class="checkbox__input" data-label="Мои задачи" name="area" value="work"
                                               type="radio" @checked(!empty($_GET['area']) ? ($_GET['area'] == 'work') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>

                                <li class="select__item">
                                    <label class="checkbox">
                                        <span class="checkbox__title"> Созданные </span>
                                        <input class="checkbox__input" data-label="Созданные" name="area" value="create"
                                               type="radio" @checked(!empty($_GET['area']) ? ($_GET['area'] == 'create') : 0)/>
                                        <span class="checkbox__fake"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Срочные
                        </span>
                        <input class="checkbox__input" type="checkbox" name="urgent" @checked($_GET['urgent'] ?? '')/>
                        <span class="checkbox__fake"></span>

                    </label>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Важные
                        </span>
                        <input class="checkbox__input" type="checkbox"
                               name="important" @checked($_GET['important'] ?? '')/>
                        <span class="checkbox__fake"></span>
                    </label>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Не активные
                        </span>
                        <input class="checkbox__input" type="checkbox" name="waiting" @checked($_GET['waiting'] ?? '')/>
                        <span class="checkbox__fake"></span>
                    </label>


                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Активные
                        </span>
                        <input class="checkbox__input" type="checkbox" name="active" @checked($_GET['active'] ?? '')/>
                        <span class="checkbox__fake"></span>
                    </label>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Приостановленые
                        </span>
                        <input class="checkbox__input" type="checkbox" name="pause" @checked($_GET['pause'] ?? '')/>
                        <span class="checkbox__fake"></span>
                    </label>

                    <label class="form__item checkbox">
                        <span class="checkbox__title">
                            Завершонные
                        </span>
                        <input class="checkbox__input" type="checkbox"
                               name="complete" @checked($_GET['complete'] ?? '')/>
                        <span class="checkbox__fake"></span>
                    </label>

                </div>
                <button class="form__submit btn btn_small btn_blue">Показать</button>

            </form>
        </div>
    </div>

@endsection
