<?php

namespace App\Models\BaseModels;

use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AllDepartment extends Pivot
{

    protected $fillable = [
        'department_id',
        'employee_department_id',
    ];


    public function department(): HasOne | null
    {
        return $this->hasOne(Department::class);
    }

    public function employeeDepartment(): HasOne | null
    {
        return $this->hasOne(EmployeeDepartment::class);
    }

}
