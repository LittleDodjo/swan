<?php

namespace App\Rules\BaseRule\Employee;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Contracts\Validation\Rule;

class DefaultRule implements Rule
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
        return $employee != null && $employee->onWork();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Этот сотрудник уже имеет причину отстуствия на работе';
    }
}
