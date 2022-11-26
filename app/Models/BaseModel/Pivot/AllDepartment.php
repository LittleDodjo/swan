<?php

namespace App\Models\BaseModel\Pivot;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
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
