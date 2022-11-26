<?php

namespace App\Rules;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Validation\Rule;

class EmployeeDepartmentRule implements Rule
{

    protected static array $departmentConfig = [1, 2, 3];
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
        if($employee == null) return false;
        return in_array($employee->rank, self::$departmentConfig);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute нельзя добавить в отдел такой ранг не соответствует';
    }
}
