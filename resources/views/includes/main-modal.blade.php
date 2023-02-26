<div id="modal" class="modal ">
    <div data-modal-close class="modal__blackout"></div>
    <div class="modal__body container">
        <div id="modalContent" class="block">
{{--<div class="task">--}}
{{--            <h2 class="task__title shine">&nbsp;</h2>--}}

{{--            <div class="task__content">--}}
{{--                <p class="task__description shine">--}}
{{--                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eum expedita facilis fugiat pariatur quidem! Ab accusantium ad animi aperiam at consectetur consequatur delectus dicta dolore doloremque eaque earum et exercitationem expedita inventore ipsum maxime minus nam nisi nostrum omnis, placeat praesentium provident quasi quis quos ratione repudiandae sit sunt unde veniam veritatis voluptas voluptatum? Aspernatur autem expedita facere! Aliquid culpa deleniti error ex exercitationem inventore itaque iure laborum natus nulla officia perspiciatis quae quia quis quisquam rerum, saepe sequi, tenetur ullam, ut velit veniam voluptate voluptatem? Accusamus beatae commodi consequatur ducimus earum eius et eum eveniet in iste maiores necessitatibus nemo neque nihil non, perferendis porro quas quia quidem, quisquam reiciendis repudiandae saepe sed sunt tempora temporibus voluptate. Aut distinctio incidunt porro sint tempora! Animi asperiores consequuntur culpa cum, esse ex iure labore minus nam nulla perferendis, placeat quam recusandae ullam velit. Culpa, dolore expedita facilis ipsum, labore minus necessitatibus nemo nesciunt non odio quibusdam velit, vero voluptatibus! Assumenda, doloremque earum esse ex, in incidunt laudantium libero maxime nam nesciunt nulla quae quam quisquam sapiente sequi unde vel voluptatibus. Cum, cupiditate, sed! Dolorem eum excepturi explicabo, fuga laudantium, magni neque numquam porro quam quia quod, ratione sint ullam voluptatibus.--}}
{{--                </p>--}}

{{--                <div class="task-info">--}}
{{--                    <ul class="task-info__list">--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item shine">&nbsp;</li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Статус</span>--}}
{{--                            <span class="task-info__value">--}}
{{--                                {{$task->status_label}}--}}
{{--                            </span>--}}
{{--                        </li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Доступ</span>--}}
{{--                            <span class="task-info__value">--}}
{{--                                {{$task->is_publish ? 'Публичная' : 'Приватная'}}--}}
{{--                            </span>--}}
{{--                        </li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Исполнитель</span>--}}
{{--                            <span class="task-info__value">--}}
{{--                                @forelse($task->users as $executor)--}}
{{--                                    {{$executor->name}}--}}
{{--                                @empty--}}
{{--                                    Не назначин--}}
{{--                                @endforelse--}}
{{--                            </span>--}}
{{--                        </li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Срочное</span>--}}
{{--                            <span class="task-info__value">--}}
{{--                                {{$task->is_urgent ? 'Да' : 'Нет'}}--}}
{{--                            </span>--}}
{{--                        </li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Важное</span>--}}
{{--                            <span class="task-info__value">--}}
{{--                                 {{$task->is_important ? 'Да' : 'Нет'}}--}}
{{--                            </span>--}}
{{--                        </li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Срок иполнения</span>--}}
{{--                            <span class="task-info__value">{{$task->date_of_delivery}}</span>--}}
{{--                        </li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Заказчик</span>--}}
{{--                            <a href="{{route('users.show', $task->owner->id)}}"--}}
{{--                               class="task-info__value link">{{$task->owner->name}}</a>--}}
{{--                        </li>--}}
{{--                        <li class="task-info__item">--}}
{{--                            <span class="task-info__label">Дата создания</span>--}}
{{--                            <span class="task-info__value">{{$task->created_at->format('d-m-Y')}}</span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}


{{--                </div>--}}

{{--            </div>--}}


{{--            <div class="task__controls task__controls_empty shine">--}}
{{--                {{$task->status}}--}}
{{--                @if($task->status == 0)--}}
{{--                    <button data-assept class="btn btn_blue btn_small">Приянть задачу</button>--}}
{{--                @elseif($task->status == 1)--}}
{{--                    <button data-pause class="btn btn_yellow btn_small">Приостановить</button>--}}
{{--                    <button data-complite class="btn btn_green btn_small">Выполнено</button>--}}
{{--                @elseif($task->status == 2)--}}
{{--                    <button data-pause class="btn btn_yellow btn_small">Продолжить</button>--}}
{{--                    <button data-complite class="btn btn_green btn_small">Выполнено</button>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
</div>
