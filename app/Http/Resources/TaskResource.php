<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'status'=>'success',
            'data' =>[
                'id'=>$this->id,
                'title'=>$this->title,
                'desc'=>$this->description,
                'status'=>$this->status,
                'displayBtn'=>($this->executor_id === null || ($this->executor_id ? $this->executor_id === Auth::user()->id : false )),
                'info'=>[
                    ['label'=>'Статус', 'url'=>null, 'value'=>$this->status_label ],
                    ['label'=>'Исполнитель', 'url'=>$this->user ? route('users.show', $this->user) : null, 'value'=>$this->user->name ?? 'Не назначин'],
                    ['label'=>'Срочное', 'url'=>null, 'value'=>$this->is_urgent ? 'Да' : 'Нет'],
                    ['label'=>'Важное', 'url'=>null, 'value'=>$this->is_important ? 'Да' : 'Нет'],
                    ['label'=>'Срок исполнения', 'url'=>null, 'value'=>$this->delivery_date],
                    ['label'=>'Заказчик', 'url'=>route('users.show', $this->owner), 'value'=>$this->owner->name, ],
                    ['label'=>'Доспуп', 'url'=>null, 'value'=>$this->is_publish ? 'Приватная' : 'Публичная'],
                    ['label'=>'Дата создания', 'url'=>null, 'value'=>$this->created_date],
                ]
            ]
        ];
    }
}
