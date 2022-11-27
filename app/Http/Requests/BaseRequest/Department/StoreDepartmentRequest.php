<?php

namespace App\Http\Requests\BaseRequest\Department;

use App\Rules\BaseRule\Department\DeputyRule;
use App\Rules\BaseRule\Department\ManagerRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreDepartmentRequest extends FormRequest
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
    #[ArrayShape(['management_id' => "string[]", 'manager_id' => "array", 'deputy_id' => "array", 'caption' => "string[]", 'short_name' => "string", 'code' => "string[]"])]
    public function rules(): array
    {
        return [
            'management_id' => [
                'required',
                'exists:managements,id',
            ],
            'manager_id' => [
                'required',
                'unique:departments,manager_id',
                'unique:employee_departments,manager_id',
                'exists:employees,id',
                new ManagerRule,
            ],
            'deputy_id' => [
                'unique:departments,deputy_id',
                'unique:employee_departments,deputy_id',
                'exists:employees,id',
                new DeputyRule,
            ],
            'caption' => [
                'required',
                'string',
                'min:5',
            ],
            'short_name' => 'string',
            'code' => [
                'required',
                'unique:departments,code',
                'unique:employee_departments,code',
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'management_id.required' => 'Необходимо указать управление',
            'management_id.exists' => 'Такого управления не существует',
            'manager_id.unique' => 'Такой сотрудник уже назначен руководителем другого отдела',
            'manager_id.required' => 'Необходимо указать руководителя отдела',
            'manager_id.exists' => 'Такого сотрудника не существует',
            'deputy_id.unique' => 'Такой сотрудник уже назначен заместителем другого отдела',
            'deputy_id.exists' => 'Такого сотрудника не существует',
            'caption.required' => 'Необходимо указать наименование отдела',
            'caption.string' => 'Неверный формат данных',
            'caption.min' => 'Наименование отдела не менее 5 символов',
            'short_name.string' => 'Неверный формат данных',
            'code.required' => 'Необходимо указать код отдела',
            'code.unique' => 'Указанный код отдела уже существует в системе',
        ];
    }
}
