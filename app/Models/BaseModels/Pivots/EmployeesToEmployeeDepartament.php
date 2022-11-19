<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class EmployeesToEmployeeDepartament
 * @package App\Models\BaseModels\Pivots
 * Модель сотрудников отдела, который зависит от сотрудника
 */
class EmployeesToEmployeeDepartament extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_departament_id',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
