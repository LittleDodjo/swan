<?php

namespace App\Http\Requests\Api\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ReasonRequest extends FormRequest
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
    #[ArrayShape(['caption' => "string", 'is_always' => "string"])] public function rules(): array
    {
        return [
            'caption' => 'required|string',
            'is_always' => 'boolean',
        ];
    }

    #[ArrayShape(['caption.required' => "string", 'caption.string' => "string", 'is_always.boolean' => "string"])] public function messages(): array
    {
        return [
            'caption.required' => 'Наименование необходимо указать',
            'caption.string' => 'Наименование должно быть строкой',
            'is_always.boolean' => 'Параметр должен быть булевым'
        ];
    }
}
