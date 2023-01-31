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
                <div class="table__coll">!</div>
                <div class="table__coll">V</div>
                <div class="table__coll">P</div>
                <div class="table__coll">X</div>
            </div>
            <div class="table__row">
                <div class="table__coll table__coll_name">
                    <a href="{{route('home')}}" class="table__link">
                        Первая задача
                    </a>
                </div>
                <div class="table__coll">!</div>
                <div class="table__coll">V</div>
                <div class="table__coll">P</div>
                <div class="table__coll">X</div>
            </div>
            <div class="table__row">
                <div class="table__coll table__coll_name">
                    <a href="{{route('home')}}" class="table__link">
                        Первая задача
                    </a>
                </div>
                <div class="table__coll">
                    <a href="{{route('home')}}" class="table__btn btn">
                        !
                    </a>
                </div>
                <div class="table__coll">
                    <a href="{{route('home')}}" class="table__btn btn">
                        V
                    </a>
                </div>
                <div class="table__coll">
                    <a href="{{route('home')}}" class="table__btn btn">
                        P
                    </a>
                </div>
                <div class="table__coll">
                    <a href="{{route('home')}}" class="table__btn btn">
                        X
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
