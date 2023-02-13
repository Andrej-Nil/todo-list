<div class="{{$task->is_important ? 'table-task table__row table__row_important' : 'table-task table__row'}}">
    <div class="table__coll table__coll_name">
        <a href="{{route('tasks.show', $task->id)}}"
           class="table__link">
            {{$task->title}}
        </a>
    </div>
    @if($task->is_urgent)
        <div class="table__coll">
        <span class="table__btn btn btn_red">
            <i class="table__btn-icon table__btn-icon_run" title="статус"></i>
        </span>
        </div>
    @endif
    <div class="table__coll">
        @if($task->status == 1)
            <div class="table__btn btn btn_blue" title="В работе">
                <i class="table__btn-icon table__btn-icon_clock"></i>
            </div>
        @elseif($task->status == 2)
            <div class="table__btn btn btn_yellow" title="Приостановленна">
                <i class="table__btn-icon table__btn-icon_pause"></i>
            </div>
        @elseif($task->status == 3)
            <div class="table__btn btn btn_green" title="Выполнена">
                <i class="table__btn-icon table__btn-icon_complete"></i>
            </div>
        @else
            <div class="table__btn btn" title="В ожидании">
                <i class="table__btn-icon table__btn-icon_clock"></i>
            </div>
        @endif

    </div>

    <div class="table__coll">
        <div claas="table-info">
            <div class="table__btn btn btn_white">
                <i class="table__btn-icon table__btn-icon_description" title="Важное"></i>
                <p class="table-info__desc">
                    {{$task->description}}
                </p>
            </div>
        </div>

    </div>
{{--    <div class="table__coll">--}}
        {{--        <a href="{{route('home')}}" class="table__btn btn btn_yellow">--}}
        {{--            <i class="table__btn-icon table__btn-icon_important" title="Важное"></i>--}}
        {{--        </a>--}}
{{--    </div>--}}

    {{--    <div class="table__coll">--}}
    {{--        <a href="{{route('home')}}" class="table__btn btn btn_blue">--}}
    {{--            <i class="table__btn-icon table__btn-icon_edit" title="Редостировать"></i>--}}
    {{--        </a>--}}
    {{--    </div>--}}
    {{--    <div class="table__coll">--}}
    {{--        <a href="{{route('home')}}" class="table__btn btn btn_red">--}}
    {{--            <i class="table__btn-icon table__btn-icon_delete" title="удалить"></i>--}}
    {{--        </a>--}}
    {{--    </div>--}}
</div>