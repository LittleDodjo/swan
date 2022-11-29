<?php

namespace App\Models\BaseModel\Pivot;

use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Сотрудники отдела edep

/**
 * @property mixed employee
 * @property mixed department
 */
class EmployeesToEmployeeDepartments extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_department_id',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(EmployeeDepartment::class, 'employee_department_id');
    }
}
