<?php

namespace App\Http\Requests\OutgoingRequest;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateOrganizationRegisterRequest extends FormRequest
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
    #[ArrayShape(['index' => "string", 'city' => "string", 'street' => "string", 'number' => "string", 'name' => "string"])]
    public function rules(): array
    {
        return [
            'index' => [
                'integer',
                fn($attribute, $value, $fail) => (strlen($value) <> 6) ? $fail("Максимальная длина индекса должна быть равна 6 символам") : true
            ],
            'city' => 'string',
            'street' => 'string',
            'number' => 'string',
            'name' => 'string',
        ];
    }

    #[ArrayShape(['index.integer' => "string", 'index.size' => "string", 'city.string' => "string", 'street.string' => "string", 'number.string' => "string", 'name.string' => "string"])]
    public function messages(): array
    {
        return [
            'index.integer' => 'Индекс должен быть числовым',
            'city.string' => 'Неверный формат наименования города',
            'street.string' => 'Неверный формат наименования улицы',
            'number.string' => 'Неверный формат номера дома',
            'name.string' => 'Неверный формат наименование организации',
        ];
    }
}
