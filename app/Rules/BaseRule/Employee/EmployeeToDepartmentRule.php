<?php

namespace App\Rules\BaseRule\Employee;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Contracts\Validation\Rule;

class EmployeeToDepartmentRule implements Rule
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
        return !($employee == null) && $employee->rank == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Такого сотрудника нельзя добавить в отдел';
    }
}
