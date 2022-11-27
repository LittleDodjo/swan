<?php

namespace App\Models\BaseModel\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Отделы зависят от сотрудника
class EmployeeToEmployeeDepartments extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_department_id',
    ];
}
