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
        return [
            'status'=>'success',
//            $data
        ];
    }
}