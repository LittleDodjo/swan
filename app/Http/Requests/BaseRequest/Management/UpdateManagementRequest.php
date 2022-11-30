<?php

namespace App\Http\Requests\BaseRequest\Management;

use App\Rules\BaseRule\Management\DependsRule;
use App\Rules\BaseRule\Management\ManagerRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * @property mixed $validated
 */
class UpdateManagementRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'short_name' => ['string'],
            'caption' => ['string', 'min:5'],
            'manager_id' => [
                'exists:employees,id',
                'unique:managements,manager_id',
                new ManagerRule
            ],
            'depends_id' => [
                'exists:employees,id',
                new DependsRule
            ],
        ];
    }

    /**
     * @return array
     */
    #[ArrayShape(['short_name.string' => "string", 'caption.string' => "string", 'caption.min' => "string", 'manager_id.exists' => "string", 'manager_id.unique' => "string", 'depends_id.exists' => "string"])] #[Pure]
    public function messages(): array
    {
        return [
            'short_name.string' => 'Неверный формат данных',
            'caption.string' => 'Неверный формат данных',
            'caption.min' => 'Длина наименования не менее 5 символов',
            'manager_id.exists' => 'Такого сотрудника не существует',
            'manager_id.unique' => 'Такой сотрудник уже является руководителем другого управления',
            'depends_id.exists' => 'Такого сотрудника не существует',
        ];
    }
}
