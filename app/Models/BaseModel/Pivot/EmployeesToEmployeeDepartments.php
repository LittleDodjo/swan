<?php

namespace App\Models\BaseModel\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Сотрудники отдела edep
class EmployeesToEmployeeDepartments extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_department_id',
    ];
}
