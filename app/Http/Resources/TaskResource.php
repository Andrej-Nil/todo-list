<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
//        $data = parent::toArray($request);
//        dd($data);
//        $data['owner_name'] = $this->owner->name;
        $dateOfDelivery = $this->date_of_delivery;
        $createdAt = $this->created_at;
        if($dateOfDelivery !== null){
            $dateOfDelivery = $dateOfDelivery->format('d-m-Y');
        }
        if($createdAt !== null){
            $createdAt = $createdAt->format('d-m-Y');
        }

        return [
            'status'=>'success',
            'data' =>[
                'id'=>$this->id,
                'title'=>$this->title,
                'desc'=>$this->description,
                'status'=>$this->status,
                'info'=>[
                    ['label'=>'Статус', 'value'=>$this->status_label],
                    ['label'=>'Исполнитель', 'value'=>$this->users[0]->name, 'url'=>"http://todo-list.local.ru/users/".$this->users[0]->id],
                    ['label'=>'Срочное', 'value'=>$this->is_urgent ? 'Да' : 'Нет'],
                    ['label'=>'Важное', 'value'=>$this->is_important ? 'Да' : 'Нет'],
                    ['label'=>'Срок исполнения', 'value'=>$dateOfDelivery ? $dateOfDelivery : 'Не указано'],
                    ['label'=>'Заказчик', 'value'=>$this->owner->name], 'url'=>"http://todo-list.local.ru/users/".$this->owner->id,
                    ['label'=>'Доспуп', 'value'=>$this->is_publish ? 'Приватная' : 'Публичная'],
                    ['label'=>'Дата создания', 'value'=>$createdAt ? $createdAt : 'Не указано'],

                ]
//
            ]
        ];
    }
}
