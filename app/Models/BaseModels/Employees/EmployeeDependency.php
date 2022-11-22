<?php

namespace App\Models\BaseModels\Employees;

use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use App\Models\BaseModels\Managements\Management;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create()
 */
class EmployeeDependency extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'management_id',
        'department_id',
        'employee_department_id',
    ];

    public function employeeDepency(){
        return $this->belongsTo(Employee::class);
    }

    public function managmentDepency(){
        return $this->belongsTo(Management::class);
    }

    public function departamentDepency(){
        return $this->belongsTo(Department::class);
    }

    public function employeeDepartamentDepency(){
        return $this->belongsTo(EmployeeDepartment::class);
    }
}
