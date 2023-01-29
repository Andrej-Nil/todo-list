<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/scss/style.scss'])
    <title>Todo-list</title>
</head>
<body>
<header class="header">
    <div class="header__inner container">
        <div class="header-logo">
            <a class="header-logo__logo" href="{{route('home')}}">
                <div class="logo">
                    <i class="logo__icon"></i>
                    <span class="logo__text">
                    <span class="logo__word">Your</span>
                    <span class="logo__word">Tasks</span>
                </span>
                </div>
            </a>
        </div>

        <div class="header-user">
            <div class="header-user__btn">
                <span class="header-user__avatar avatar">
                    <img class="avatar__img" src="{{asset('/image/icon/user.svg')}}" alt="avatar">
                </span>

                <i class="header-user__arrow"></i>
            </div>

            <div class="header-menu">
                <ul class="header-menu__list">
                    <li class="header-menu__item">
                        <a href="" class="header-menu__link">Вход</a>
                    </li>
                    <li class="header-menu__item">
                        <a href="" class="header-menu__link">Регистрация</a>
                    </li>
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
