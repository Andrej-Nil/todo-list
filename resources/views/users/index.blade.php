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

    <div class="content two-coll">
        @foreach($users as $user)
            @include('includes.users-card')
        @endforeach


    </div>
@endsection
