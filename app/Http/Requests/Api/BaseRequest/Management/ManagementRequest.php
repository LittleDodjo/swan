<?php

namespace App\Http\Requests\Api\BaseRequest\Management;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;


/**
 * @property mixed employee_depends_id
 * @property mixed employee_manager_id
 */
class ManagementRequest extends FormRequest
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
    #[ArrayShape(['employee_depends_id' => "string", 'employee_manager_id' => "string", 'caption' => "string"])]
    public function rules(): array
    {
        return [
            'employee_depends_id' => 'required|integer',
            'employee_manager_id' => 'required|integer|unique:managements',
            'caption' => 'required|string',
        ];
    }


    #[ArrayShape(['employee_depends_id.required' => "string", 'employee_depends_id.integer' => "string", 'employee_manager_id.required' => "string", 'employee_manager_id.integer' => "string", 'employee_manager_id.unique' => "string", 'caption' => "string"])]
    public function messages(): array
    {
        return [
            'employee_depends_id.required' => 'Необходимо указать зависимого человека',
            'employee_depends_id.integer' => 'Неверный формат данных',
            'employee_manager_id.required' => 'Необходимо указать руководителя',
            'employee_manager_id.integer' => 'Неверный формат данных',
            'employee_manager_id.unique' => 'Такого пользователя нельзя привязать к управлению',
            'caption' => 'Необходимо указать наименование',
        ];
    }
}
