@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="top">
        <h1 class="main-title">Создание задачи</h1>
    </div>

    <div class="content">
        <form class="form block" action="{{route('tasks.store')}}" method="POST">
            @csrf
            <div class="form__inputs">
                <input class="input" type="text" placeholder="Название" name="title">

                <textarea class="input " name="description" cols="30" rows="5" placeholder="Описание"></textarea>

            </div>
            <div class="form__inputs">
                <p class="form__subtitle">Дополнительно</p>
                <div class="form__optionally">
                    <label class="checkbox form__item">
                        <span class="checkbox__title"> Важное </span>
                        <input class="checkbox__input" name="is_important" value="1" type="checkbox"/>
                        <span class="checkbox__fake"></span>
                    </label>
                    <label class="checkbox form__item">
                        <span class="checkbox__title"> Срочное </span>
                        <input class="checkbox__input" name="is_urgent" value="1" type="checkbox"/>
                        <span class="checkbox__fake"></span>
                    </label>

                    <label class="date form__item form__item_span-two">
                        <span class="date__title"> Дата исполнения: </span>
                        <input class="date__input input" name="date_of_delivery" value="1" type="date"/>
                    </label>

                    <label class="checkbox form__item">
                        <span class="checkbox__title"> Добавить в общий стек </span>
                        <input class="checkbox__input" name="is_publish" value="1" type="checkbox"/>
                        <span class="checkbox__fake"></span>
                    </label>

                    <input type="hidden" name="owner_id" value="{{Auth::user()->id}}">
                </div>


            </div>

            <div class="form__bottom">
                <button class="btn btn_blue btn_small" type="submit">Создать</button>
            </div>

        </form>
    </div>
@endsection
