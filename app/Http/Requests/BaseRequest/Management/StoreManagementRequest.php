<?php

namespace App\Http\Requests\BaseRequest\Management;

use App\Rules\BaseRule\Management\DependsRule;
use App\Rules\BaseRule\Management\ManagerRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class StoreManagementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['short_name' => "string[]", 'caption' => "string[]", 'manager_id' => "array", 'depends_id' => "array"])]
    public function rules(): array
    {
        return [
            'short_name' => ['string'],
            'caption' => ['required', 'string', 'min:5'],
            'manager_id' => [
                'required',
                'exists:employees,id',
                'unique:managements,manager_id',
                new ManagerRule
                ],
            'depends_id' => [
                'required',
                'exists:employees,id',
                new DependsRule
            ],
        ];
    }

    /**
     * @return array
     */
    #[ArrayShape(['short_name.string' => "string", 'caption.string' => "string", 'caption.required' => "string", 'caption.min' => "string", 'manager_id.required' => "string", 'manager_id.exists' => "string", 'manager_id.unique' => "string", 'depends_id.required' => "string", 'depends_id.exists' => "string"])] #[Pure]
    public function messages(): array
    {
        return [
            'short_name.string' => 'Неверный формат данных',
            'caption.string' => 'Неверный формат данных',
            'caption.required' => 'Необходимо указать наименование отдела',
            'caption.min' => 'Длина наименования не менее 5 символов',
            'manager_id.required' => 'Необходимо указать руководителя управления',
            'manager_id.exists' => 'Такого сотрудника не существует',
            'manager_id.unique' => 'Такой сотрудник уже является руководителем другого управления',
            'depends_id.required' => 'Необходимо указать сотрудника, которому подчиняется управление',
            'depends_id.exists' => 'Такого сотрудника не существует',
        ];
    }

}
