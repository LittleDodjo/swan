<?php

namespace App\Http\Requests\Api\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed employee_id
 * @property mixed employee_depends_id
 */
class EmployeeDecencyRequest extends FormRequest
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
    #[ArrayShape(['employee_id' => "string", 'employee_depends_id' => "string"])] public function rules(): array
    {
        return [
            'employee_id' => 'required|integer',
            'employee_depends_id' => 'required|integer'
        ];
    }

    #[ArrayShape(['employee_id.required' => "string", 'employee_id.integer' => "string", 'employee_depends_id.integer' => "string", 'employee_depends_id.required' => "string"])] public function messages(): array
    {
        return [
            'employee_id.required' => 'Необходимо указать пользователя',
            'employee_id.integer' => 'Неверный идентификатор пользователя',
            'employee_depends_id.integer' => 'Необходимо указать пользователя',
            'employee_depends_id.required' => 'Неверный идентификатор пользователя',
        ];
    }
}
