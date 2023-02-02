@extends('layouts.app')

@section('content')
    <div class="top">
        <h1 class="main-title">Текущие задачи</h1>

        <a href="{{route('home')}}" class="btn btn_blue">Создать задачу</a>
    </div>


    <div class="table">
        <div class="table__content">



            <div class="table__row">
                <div class="table__coll table__coll_name">
                    <a href="{{route('home')}}" class="table__link">
                        Первая задача
                    </a>
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
@endsection
