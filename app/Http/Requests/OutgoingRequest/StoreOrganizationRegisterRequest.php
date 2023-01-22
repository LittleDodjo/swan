<?php

namespace App\Http\Requests\OutgoingRequest;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreOrganizationRegisterRequest extends FormRequest
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
                'required',
                'integer',
                fn($attribute, $value, $fail) => (strlen($value) <> 6) ? $fail("Максимальная длина индекса должна быть равна 6 символам") : true
            ],
            'city' => 'string|required',
            'street' => 'string|required',
            'number' => 'string|required',
            'name' => 'string|required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'index.integer' => 'Индекс должен быть числовым',
            'index.size' => 'Максимальная длина индекса должна быть равна 6 символам',
            'index.required' => 'Индекс указать обязательно',
            'city.string' => 'Неверный формат наименования города',
            'city.required' => 'Необходимо указать город',
            'street.string' => 'Неверный формат наименования улицы',
            'street.required' => 'Улицу обязательно необходимо указать',
            'number.string' => 'Неверный формат номера дома',
            'number.required' => 'Необходимо указать номер дома',
            'name.string' => 'Неверный формат наименование организации',
            'name.required' => 'Необходимо указать наименование организации',
        ];
    }
}
