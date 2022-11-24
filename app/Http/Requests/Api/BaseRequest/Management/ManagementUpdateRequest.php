<?php

namespace App\Http\Requests\Api\BaseRequest\Management;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed employee_depends_id
 * @property mixed employee_manager_id
 */
class ManagementUpdateRequest extends FormRequest
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


    #[ArrayShape(['employee_depends_id' => "string", 'employee_manager_id' => "string", 'caption' => "string", 'short_name' => "string"])]
    public function rules(): array
    {
        return [
            'employee_depends_id' => 'integer',
            'employee_manager_id' => 'integer|unique:managements',
            'caption' => 'min:3|string',
            'short_name' => 'min:2|string',
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['caption.string' => "string", 'caption.min' => "string", 'short_name.string' => "string", 'short_name.min' => "string", 'employee_depends_id.integer' => "string", 'employee_manager_id.integer' => "string", 'employee_manager_id.unique' => "string"])]
    public function messages(): array
    {
        return [
            'caption.string' => 'Невереный формат данных',
            'caption.min' => 'Слишком короткое наименование',
            'short_name.string' => 'Невереный формат данных',
            'short_name.min' => 'Слишком короткое наименование',
            'employee_depends_id.integer' => 'Неверный формат данных',
            'employee_manager_id.integer' => 'Неверный формат данных',
            'employee_manager_id.unique' => 'Такой сотрудник уже является руководителем другого управления'
        ];
    }

}
