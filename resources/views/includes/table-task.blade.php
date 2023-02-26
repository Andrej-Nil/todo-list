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
            <i class="table__btn-icon table__btn-icon_run" title="Срочное"></i>
        </span>
        </div>
    @endif
    <div class="table__coll">
        @if($task->status == 1)
            <div class="table__btn btn btn_blue" title="{{$task->status_label}}">
                <i class="table__btn-icon table__btn-icon_clock"></i>
            </div>
        @elseif($task->status == 2)
            <div class="table__btn btn btn_yellow" title="{{$task->status_label}}">
                <i class="table__btn-icon table__btn-icon_pause"></i>
            </div>
        @elseif($task->status == 3)
            <div class="table__btn btn btn_green" title="{{$task->status_label}}">
                <i class="table__btn-icon table__btn-icon_complete"></i>
            </div>
        @else
            <div class="table__btn btn" title="{{$task->status_label}}">
                <i class="table__btn-icon table__btn-icon_clock"></i>
            </div>
        @endif

    </div>

    @if($task->is_publish == 0)
        <div class="table__coll">
            <div class="table__btn btn " title="Приватная">
                <i class="table__btn-icon table__btn-icon_private"></i>
            </div>
        </div>
    @endif

    @if($task->is_publish == 1)
        <div class="table__coll">
            <div class="table__btn btn " title="Приватная">
                <i class="table__btn-icon table__btn-icon_publish"></i>
            </div>
        </div>
    @endif

    <div class="table__coll">
        <div data-show-info="{{$task->id}}" class="table__btn btn btn_white">
            <i class="table__btn-icon table__btn-icon_description" title="Описание"></i>
        </div>
    </div>
</div>
