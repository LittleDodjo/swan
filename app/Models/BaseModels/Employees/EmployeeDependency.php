<?php

namespace App\Models\BaseModels\Employees;

use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use App\Models\BaseModels\Managements\Management;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Возвращает зависимость к сотруднику
     * @return BelongsTo|null
     */
    public function employeeDependency(): BelongsTo | null
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Возвращает зависимость к управлению
     * @return BelongsTo|null
     */
    public function managementsDependency(): BelongsTo | null
    {
        return $this->belongsTo(Management::class);
    }

    /**
     * Возвращает зависимость к отделению (который зависит от управления)
     * @return BelongsTo|null
     */
    public function departmentsDependency(): BelongsTo | null
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Возвращает зависимость к отделению (который зависит от сотрудника)
     * @return BelongsTo|null
     */
    public function employeeDepartmentsDependency(): BelongsTo | null
    {
        return $this->belongsTo(EmployeeDepartment::class);
    }
}
