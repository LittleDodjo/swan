<?php

namespace App\Http\Requests\Api\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'short_name' => 'string',
            'is_manager' => 'boolean',
            'is_primary_manager' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'caption.required' => 'Необходимо указать наименование должности',
        ];
    }
}
