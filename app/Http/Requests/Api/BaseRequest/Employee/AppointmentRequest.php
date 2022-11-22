<?php

namespace App\Http\Requests\Api\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AppointmentRequest extends FormRequest
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
    #[ArrayShape(['caption' => "string", 'short_name' => "string", 'is_manager' => "string", 'is_primary_manager' => "string"])] public function rules(): array
    {
        return [
            'caption' => 'required|string',
            'short_name' => 'string',
            'is_manager' => 'boolean',
            'is_primary_manager' => 'boolean',
        ];
    }

    #[ArrayShape(['caption.required' => "string"])] public function messages(): array
    {
        return [
            'caption.required' => 'Необходимо указать наименование должности',
        ];
    }
}
