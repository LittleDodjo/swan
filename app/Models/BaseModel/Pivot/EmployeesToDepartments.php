<?php

namespace App\Models\BaseModel\Pivot;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesToDepartments extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }
}
