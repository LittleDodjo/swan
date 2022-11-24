<?php

namespace App\Http\Requests\Api\BaseRequest\Department;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed employee_primary_manager_id
 * @property mixed employee_manager_id
 * @property mixed management_depends
 */
class DepartmentRequest extends FormRequest
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
    #[ArrayShape(['caption' => "string", 'short_name' => "string", 'display_number' => "string", 'employee_primary_manager_id' => "string", 'employee_manager_id' => "string", 'management_depends' => "string"])]
    public function rules(): array
    {
        return [
            'caption' => 'required|string',
            'short_name' => 'required|string',
            'display_number' => 'required|string|unique:departments,display_number|unique:employee_departments,display_number',
            'employee_primary_manager_id' => 'required|integer|unique:departments,employee_primary_manager_id|unique:employee_departments,employee_primary_manager_id',
            'employee_manager_id' => 'integer|unique:departments,employee_primary_manager_id|unique:employee_departments,employee_primary_manager_id',
            'management_depends' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'caption.string' => 'Неверный формат данных',
            'caption.required' => 'Необходимо указать короткое имя',
            'short_name.required' => 'Необходимо указать короткое имя',
            'short_name.string' => 'Неверный формат данных',
            'display_number.required' => 'Необходимо указать код отдела',
            'display_number.string' => 'Неверный формат данных',
            'display_number.unique' => 'Отдел с таким кодом уже существует в системе',
            'employee_primary_manager_id.required' => 'Необходимо указать руководителя отдела',
            'employee_primary_manager_id.integer' => 'Неверный формат данных',
            'employee_primary_manager_id.unique' => 'Такой сотрудник уже является руководителем другого отдела',
            'employee_manager_id.required' => 'Необходимо указать руководителя отдела',
            'employee_manager_id.integer' => 'Неверный формат данных',
            'employee_manager_id.unique' => 'Такой сотрудник уже является заместителем другого отдела',
        ];
    }
}
