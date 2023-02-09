@extends('layouts.app')


@section('content')
    <div class="top">
        <h1 class="main-title">Название задачи</h1>
        <div class="top__controls">
            <a href="{{route('tasks.edit', 5)}}" class="btn btn_small btn_yellow">Редостировать</a>

            <form action="{{}}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn_small btn_red">Удалить</button>
            </form>
        </div>
    </div>

    <div class="content">
        <div class="task block">
            <div class="task__content">
                <p class="task__description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias cumque facilis iusto necessitatibus nobis placeat provident qui quis sapiente sequi. Autem deleniti distinctio sunt? Alias, autem, commodi culpa eaque facilis ipsum, laboriosam nesciunt obcaecati qui ratione reprehenderit sequi ullam voluptate.
                </p>
                <div class="task-info">
                    <ul class="task-info__list">
                        <li class="task-info__item">
                            <span class="task-info__label">Статус</span>
                            <span class="task-info__value">В работе</span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Доступ</span>
                            <span class="task-info__value">Публичная</span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Исполнитель</span>
                            <span class="task-info__value">Микола Митя</span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Срочное</span>
                            <span class="task-info__value">Да</span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Важное</span>
                            <span class="task-info__value">Да</span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Срок иполнения</span>
                            <span class="task-info__value">20.03.2023</span>
                        </li>
                        <li class="task-info__item">
                            <span class="task-info__label">Заказчик</span>
                            <span class="task-info__value">Андрей The Best</span>
                        </li>

                    </ul>
                </div>

            </div>



        </div>
    </div>
@endsection
