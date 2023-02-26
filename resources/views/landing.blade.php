@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="about block">
            <div class="about__top">

            </div>

            <div class="about__bottom">
                <a href="{{ route('login') }}" class="btn btn_green">Вход</a>
                <a href="{{ route('register') }}" class="btn btn_blue">Регистрация</a>
            </div>
        </div>


    </div>

@endsection
