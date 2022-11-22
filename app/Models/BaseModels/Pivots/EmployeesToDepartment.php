<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class EmployeesToDepartament
 * @package App\Models\BaseModels\Pivots
 * Модель сотрудников отдела
 */
class EmployeesToDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
