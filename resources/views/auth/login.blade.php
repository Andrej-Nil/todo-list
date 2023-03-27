@extends('layouts.app')

@section('content')
    <div class="top">
        <h1 class="main-title">Вход</h1>
    </div>

    <div class="content">
        <div class="block">
            <form class="form middle-container" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="control">
                    <label for="email" class="control__label">Почта</label>
                    <input type="text" id="email" name="email" class="input @error('email')error @enderror">
                    @error('email')
                        <span class="control__message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="control">
                    <label for="password" class="control__label">Пароль</label>
                    <input type="password" id="password" name="password" class="input @error('password')error @enderror">
                    @error('password')
                        <span class="control__message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form__bottom">
                    <a href="{{ route('register') }}" class="form__link">Регистрация</a>
                    <label class="checkbox">
                        <input class="checkbox__input"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : ''}}/>
                        <span class="checkbox__fake"></span>
                        <span class="checkbox__title"> Запомнить </span>
                    </label>
                    <button class="btn btn_blue btn_small" type="submit">Вход</button>
                </div>
            </form>
        </div>
    </div>

@endsection
