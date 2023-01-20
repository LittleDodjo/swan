<?php

namespace App\Http\Requests\Outgoing\Stamps;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreStampRegisterRequest extends FormRequest
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
    #[ArrayShape(['value' => "string"])]
    public function rules(): array
    {
        return [
            'value' => 'unique:stamp_registers|required|numeric|between:0.01,99.99',
        ];
    }


    #[ArrayShape(['value.unique' => "string", 'value.required' => "string", 'value.numeric' => "string", 'value.between' => "string"])]
    public function messages(): array
    {
        return [
            'value.unique' => 'Такой номинал уже существует',
            'value.required' => 'Необходимо указать номинал марки',
            'value.numeric' => 'Номинал марки должен быть числовым',
            'value.between' => 'Стоимость должна быть не менее 0.01 и не более 99.99 рублей',
        ];
    }
}
