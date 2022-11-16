<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeToEmployeeDepency extends Pivot
{
    protected $fillable = [
        'employee_departament_id',
        'employee_id',
    ];


    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
