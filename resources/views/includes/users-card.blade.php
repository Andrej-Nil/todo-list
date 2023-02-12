<div class="user-card block">
    <a href="{{route('users.show', $user->id)}}" class="user-card__link">
        <div class="user-card__inner">
            <div class="user-card__photo">
                <img class="user-card__img" src="{{asset('image/img/default-user.png')}}"/>
            </div>


            <div class="user-card__content">
                <p class="user-card__title">{{$user->name}}</p>

                <div class="user-card__info">
                    <p class="user-card__subtitle">Информация о задачах</p>
                    <ul class="user-card__list">
                        <li class="user-card__item">
                            <span class="user-card__label">Активные</span>
                            <span class="user-card__value">2</span>
                        </li>
                        <li class="user-card__item">
                            <span class="user-card__label">Завершенные</span>
                            <span class="user-card__value">2</span>
                        </li>
                        <li class="user-card__item">
                            <span class="user-card__label">Созданные(общий стек)</span>
                            <span class="user-card__value">2</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </a>
</div>
