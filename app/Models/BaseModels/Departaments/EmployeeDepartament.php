<?php

namespace App\Models\BaseModels\Departaments;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use App\Models\BaseModels\Pivots\EmployeesToEmployeeDepartament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepartament extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_depends',
        'employee_manager_id',
        'employee_primary_manager_id',
        'caption',
        'short_name',
        'display_number',
    ];

    public function employeeDepends(){
        return $this->hasOne(Employee::class);
    }

    public function employeeManager(){
        return $this->hasOne(Employee::class);
    }

    public function employeePrimaryManager(){
        return $this->hasOne(Employee::class);
    }

    public function employees(){
        return $this->hasMany(EmployeesToEmployeeDepartament::class);
    }

}
