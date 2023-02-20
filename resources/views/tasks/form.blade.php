<div class="form__inputs">
    <input class="input" type="text" placeholder="Название" value="{{old('title') ?? $task->description ?? ''}}"
           name="title">

    <textarea class="input " name="description" cols="30" rows="5"
              placeholder="Описание">{{old('description') ?? $task->description ?? ''}}</textarea>

</div>
<div class="form__inputs">
    <p class="form__subtitle">Дополнительно</p>
    <div class="form__optionally">
        <label class="checkbox form__item">
            <span class="checkbox__title"> Важное </span>
            <input class="checkbox__input" name="is_important" value="1"
                   type="checkbox" @checked(old('is_important') ?? $task->is_important ?? '' )/>
            <span class="checkbox__fake"></span>
        </label>
        <label class="checkbox form__item">
            <span class="checkbox__title"> Срочное </span>
            <input class="checkbox__input" name="is_urgent" value="1"
                   type="checkbox" @checked(old('is_urgent') ?? $task->is_urgent ?? '')/>
            <span class="checkbox__fake"></span>
        </label>

        <label class="date form__item form__item_span-two">
            <span class="date__title"> Дата исполнения: </span>
            <input class="date__input input" name="date_of_delivery" type="date"
                   value="{{old('date_of_delivery') ?? $task->date_of_delivery ?? ''}}"/>
        </label>

        <label class="checkbox form__item">
            <span class="checkbox__title"> Добавить в общий стек </span>
            <input class="checkbox__input" name="is_publish" value="1"
                   type="checkbox" @checked(old('is_publish') ?? $task->is_publish ?? '')/>
            <span class="checkbox__fake"></span>
        </label>
        @if(empty($task))
            <label class="checkbox form__item">
                <span class="checkbox__title"> В работе </span>
                <input class="checkbox__input" name="status" value="1"
                       type="checkbox" @checked(old('status') ?? $task->status ?? '')/>
                <span class="checkbox__fake"></span>
            </label>
        @endif
    </div>

</div>
