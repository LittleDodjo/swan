<?php

namespace App\Rules\BaseRule\Department;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Contracts\Validation\Rule;

class DeputyRule implements Rule
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
    public function passes($attribute, $value): bool
    {
        $employee = Employee::find($value);
        return !($employee == null) && $employee->rank == 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Сотрудника с таким рангом нельзя назначить заместителем отдела';
    }
}
