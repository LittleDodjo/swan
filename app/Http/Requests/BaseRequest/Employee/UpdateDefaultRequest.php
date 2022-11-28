<?php

namespace App\Http\Requests\BaseRequest\Employee;

use App\Rules\BaseRule\Employee\DefaultRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateDefaultRequest extends FormRequest
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
    #[ArrayShape(['to_date' => "string[]", 'from_date' => "string[]", 'employee_id' => "array", 'deputy_employee_id' => "array", 'reason_id' => "string[]"])]
    public function rules(): array
    {
        return [
            'to_date' => [
                'date',
                'date_format:Y-m-d',
            ],
            'from_date' => [
                'date',
                'date_format:Y-m-d',
                'before:to_date'
            ],
            'employee_id' => [
                'exists:employees,id',
                new DefaultRule,
            ],
            'deputy_employee_id' => [
                'exists:employees,id',
                'different:employee_id',
                new DefaultRule,
            ],
            'reason_id' => [
                'exists:reasons,id',
            ],
        ];
    }

    #[ArrayShape(['to_date.date' => "string", 'to_date.date_format' => "string", 'from_date.date' => "string", 'from_date.before' => "string", 'from_date.date_format' => "string", 'employee_id.exists' => "string", 'reason_id.exists' => "string", 'deputy_employee_id.exist' => "string", 'deputy_employee_id.different' => "string"])]
    public function messages(): array
    {
        return [
            'to_date.date' => 'Неверный формат даты',
            'to_date.date_format' => 'Дата должна быть формата ГГГГ-ММ-ДД',
            'from_date.date' => 'Неверный формат даты',
            'from_date.before' => 'Нельзя указать начальную дату больше конечной',
            'from_date.date_format' => 'Формат даты не совпатадет с ГГГГ-ММ-ДД',
            'employee_id.exists' => 'Такого сотрудника не существует',
            'reason_id.exists' => 'Такой причины не найдено в системе',
            'deputy_employee_id.exist' => 'Такого сотнудника не существует',
            'deputy_employee_id.different' => 'Нельзя указывать двух одинаковых сотрудников',
        ];
    }
}
