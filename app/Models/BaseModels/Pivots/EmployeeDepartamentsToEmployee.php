<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeDepartamentsToEmployee extends Pivot
{

    protected $fillable = [
        'departament_id',
        'employee_id',
    ];


    public function employees(){
        return $this->hasMany(Employee::class);
    }

}