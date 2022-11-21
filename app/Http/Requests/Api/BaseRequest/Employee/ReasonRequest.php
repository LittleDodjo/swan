<?php

namespace App\Http\Requests\Api\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;

class ReasonRequest extends FormRequest
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
            'caption' => 'required|string',
            'is_always' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'caption.required' => 'Наименование необходимо указать',
            'caption.string' => 'Наименование должно быть строкой',
            'is_always.boolean' => 'Параметр должен быть булевым'
        ];
    }
}
