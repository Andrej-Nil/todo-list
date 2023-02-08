@extends('layouts.app')

@section('content')
    <div class="top">
        <h1 class="main-title">Регистрация</h1>
    </div>

    <div class="content">
        <div class="block">
            <form class="form middle-container" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="control">
                    <label for="name" class="control__label">Имя</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input" required autocomplete="name"
                           autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="control">
                    <label for="email" class="control__label">Почта</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" class="input" required
                           autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="control">
                    <label for="password" class="control__label">Пароль</label>
                    <input id="password" type="password" name="password" class="input" required
                           autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="control">
                    <label for="password-confirm" class="control__label">Повтаприте пороль</label>
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required
                           autocomplete="new-password">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="form__bottom">
                    <a href="{{ route('login') }}" class="form__link">Вход</a>

                    <button class="btn btn_blue btn_small" type="submit">Регистрация</button>
                </div>
            </form>
        </div>
    </div>


@endsection
