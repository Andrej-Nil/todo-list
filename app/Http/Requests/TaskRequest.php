<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' =>['required'],
            'description'=>['required'],
            'status'=>['string', 'between:0,3'],
            'is_important'=>['integer', 'between:0,1'],
            'is_urgent'=>['integer', 'between:0,1'],
            'is_publish'=>['integer', 'between:0,1'],
            'date_of_delivery'=>['date_format:Y-m-d', 'nullable'],
        ];
    }

    public function messages() {
        return [
            'title.required'=>'Введите название',
            'description.required'=>'Описание должно быть заполнено'
        ];
    }
}
