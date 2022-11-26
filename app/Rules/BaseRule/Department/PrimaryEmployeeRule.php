<?php

namespace App\Rules\BaseRule\Department;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Validation\Rule;

class PrimaryEmployeeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $employee = Employee::find($value);
        return !($employee == null) && $employee->rank == 3;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Сотрудника с таким рангом нельзя добавить в отдел как руководителя';
    }
}
