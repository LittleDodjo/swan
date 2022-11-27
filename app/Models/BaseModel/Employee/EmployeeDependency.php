<?php

namespace App\Models\BaseModel\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDependency extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
        'management_id',
        'employee_department_id',
    ];
}
