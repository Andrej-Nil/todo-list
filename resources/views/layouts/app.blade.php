<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/scss/style.scss'])
    <title>Todo-list</title>
</head>
<body>
<header class="header">
    <div class="header__inner container">
        <div class="header-logo">
            <a class="header-logo__logo" href="{{route('home')}}">
                <img class="logo" src="{{asset('image/logo.svg')}}" alt="logo">
            </a>
        </div>

        @auth
            <nav class="nav">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{route('tasks.index')}}" class="nav__link">Задачи</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('users.index')}}" class="nav__link">Пользователи</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('tasks.create')}}" class="btn btn_small btn_blue">Создать задачу</a>
                    </li>
                </ul>
            </nav>
{{Auth::user()->name}}
            <div class="header-user">
                <div id="userBtn" class="header-user__btn">
                <span class="header-user__avatar avatar">
                    <img class="avatar__img" src="{{asset('/image/icon/user.svg')}}" alt="avatar">
                </span>

                    <i class="header-user__arrow"></i>
                </div>
                <div id="userMenu" data-menu-status="close" class="header-menu">
                    <ul class="header-menu__list">

                        <li class="header-menu__item">
                            <a href="{{ route('login') }}" class="header-menu__link">Профиль</a>
                        </li>


                        @if (Auth::user()->is_admin)
                            <li class="header-menu__item">
                                <span class="header-menu__link">admin</span>

                            </li>

                        @endif

                        <li class="header-menu__item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="header-menu__link header-menu__link_logout">Выход</button>
                            </form>
                            {{--                        <a href="{{ route('login') }}" class="header-menu__link">Профиль</a>--}}
                        </li>

                        @else

                            <div class="header__login">
                                <a href="{{ route('login') }}" class="btn btn_small btn_green">Вход</a>
                                <a href="{{ route('register') }}" class="btn btn_small btn_blue">Регистрация</a>
                            </div>

                        @endauth
                    </ul>
                </div>
            </div>
    </div>
</header>
<main class="container">


    @yield('content')
</main>

@vite(['resources/js/app.js'])
</body>
</html>
