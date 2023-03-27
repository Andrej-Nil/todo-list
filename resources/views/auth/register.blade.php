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
                    <input type="text" name="name" value="{{ old('name') }}" class="input @error('name')error @enderror">
                    @error('name')
                        <span class="control__message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control">
                    <label for="email" class="control__label">Почта</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" class="input @error('email')error @enderror">
                    @error('email')
                        <span class="control__message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="control">
                    <label for="password" class="control__label">Пароль</label>
                    <input id="password" type="password" name="password" class="input @error('password')error @enderror">
                    @error('password')
                        <span class="control__message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control">
                    <label for="password-confirm" class="control__label">Повторите пороль</label>
                    <input id="password-confirm" type="password" name="password_confirmation" class="input @error('password_confirmation')error @enderror">
                    @error('password_confirmation')
                    <span class="control__message">{{ $message }}</span>
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
