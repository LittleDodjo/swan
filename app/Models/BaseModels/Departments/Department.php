<?php

namespace App\Models\BaseModels\Departments;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managements\Management;
use App\Models\BaseModels\Pivots\EmployeesToDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static find(mixed $department_id)
 * @property mixed management_depends
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'management_id',
        'employee_manager_id',
        'employee_primary_manager_id',
        'caption',
        'short_name',
        'display_number',
    ];

    /**
     * Возвращает отношение к управлению (один к одному)
     * @return HasOne|null
     */
    public function managementDepends(): HasOne|null
    {
        return $this->hasOne(Management::class);
    }

    /**
     * Возвращает заместителя руководителя
     * @return HasOne|null
     */
    public function employeeManager(): HasOne|null
    {
        return $this->hasOne(Employee::class);
    }

    /**
     * Возвращает руководителя отделения
     * @return HasOne|null
     */
    public function employeePrimaryManager(): HasOne|null
    {
        return $this->hasOne(Employee::class);
    }

    /**
     * Возвращает сотрудников отделения
     * @return HasMany|null
     */
    public function employees(): HasMany|null
    {
        return $this->hasMany(EmployeesToDepartment::class);
    }
}
