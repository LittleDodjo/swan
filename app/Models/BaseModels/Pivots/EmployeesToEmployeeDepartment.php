<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class EmployeesToEmployeeDepartment
 * @package App\Models\BaseModels\Pivots
 * Модель сотрудников отдела, который зависит от сотрудника
 */
class EmployeesToEmployeeDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_department_id',
    ];

    /**
     * Отношение к сотруднику
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
