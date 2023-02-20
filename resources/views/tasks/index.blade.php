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
                            <p data-select-title class="select__title">Сначало новые</p>
                            <i class="select__arrow"></i>
                        </div>
                        <div data-dropdown class="select__dropdown">
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

                    <div data-select="close" class="select">

                        <div data-select-btn class="select__top">
                            <p data-select-title class="select__title"> Отображать: 10</p>
                            <i class="select__arrow"></i>
                        </div>
                        <div data-dropdown class="select__dropdown">
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
