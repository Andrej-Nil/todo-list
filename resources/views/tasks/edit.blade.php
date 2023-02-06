@extends('layouts.app')

@section('content')
    <div class="top">
        <h1 class="main-title">Редостирование задачи</h1>
    </div>

    <div class="content">
        <form class="form block" action="{{route('tasks.update', 5)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form__inputs">
                <input form="filter" class="input" type="text" placeholder="Название" name="value">
                <textarea class="input " name="description" id="" cols="30" rows="5" placeholder="Описание"></textarea>

            </div>
            <div class="form__inputs">
                <p class="form__subtitle">Дополнительно</p>
                <div class="form__optionally">
                    <label class="checkbox form__item">
                        <span class="checkbox__title"> Важное </span>
                        <input class="checkbox__input" name="sorting" value="2" type="checkbox"/>
                        <span class="checkbox__fake"></span>
                    </label>
                    <label class="checkbox form__item">
                        <span class="checkbox__title"> Срочное </span>
                        <input class="checkbox__input" name="sorting" value="2" type="checkbox"/>
                        <span class="checkbox__fake"></span>
                    </label>

                    <label class="date form__item form__item_span-two">
                        <span class="date__title"> Дата исполнения: </span>
                        <input class="date__input input" name="sorting" value="2" type="date"/>
                    </label>
                </div>
            </div>

            <div class="form__bottom">
                <button class="btn btn_blue btn_small" type="submit">Сохранить</button>
            </div>

        </form>
    </div>
@endsection
