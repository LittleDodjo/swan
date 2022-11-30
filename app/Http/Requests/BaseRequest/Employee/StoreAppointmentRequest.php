<?php

namespace App\Http\Requests\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreAppointmentRequest extends FormRequest
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
    #[ArrayShape(['name' => "string", 'short_name' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|min:5',
            'short_name' => 'string',
        ];
    }

    #[ArrayShape(['name.required' => "string", 'name.min' => "string", 'short_name.string' => "string"])]
    public function messages(): array
    {
        return [
            'name.required' => 'Необходимо указать наименование должности',
            'name.min' => 'Слишком короткое наименование',
            'short_name.string' => 'Неверный формат данных',
        ];
    }
}
