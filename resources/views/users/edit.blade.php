@extends('layouts.app')

@section('content')
    <div class="top">
        <h1 class="main-title">Редоктирование профиля</h1>
    </div>

    <div class="content">
        <form action="{{route('users.update', 5)}}" method="post" class="user-edit block">
            @csrf
            @method('put')
            <div class="user-edit__preview">
                <img src="{{asset('image/img/default-user.png')}}" alt="" class="user-edit__photo">

                <label class="file">
                    <input class="file__input" type="file" name="photo">
                    <span class="file__fake btn btn_blue btn_small">Выбрать фото</span>
                </label>
            </div>
            <div class="form__inputs">
                <input type="text" name="name" value="{{ old('name') }}" class="input" required autocomplete="name"
                       autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror


                <input type="text" id="email" name="email" value="{{ old('email') }}" class="input" required
                       autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <input id="password" type="password" name="password" class="input" required
                       autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror


                <input id="password-confirm" type="password" class="input" name="password_confirmation" required
                       autocomplete="new-password">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror


            </div>
            <button class="btn btn_blue btn_small" type="submit">Сохранить</button>

        </form>
    </div>
@endsection
