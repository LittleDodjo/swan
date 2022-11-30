<?php

namespace App\Http\Requests\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreReasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['caption' => "string", 'is_always' => "string"])]
    public function rules(): array
    {
        return [
            'caption' => 'required',
            'is_always' => 'boolean|required',
        ];
    }


    #[ArrayShape(['caption.required' => "string", 'is_always.required' => "string", 'is_always.boolean' => "string"])]
    public function messages(): array
    {
        return [
            'caption.required' => 'Необходимо указать наименование причины',
            'is_always.required' => 'Статус указать обязательно',
            'is_always.boolean' => 'Неверный формат данных',
        ];
    }
}
