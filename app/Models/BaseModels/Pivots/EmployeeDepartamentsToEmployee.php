<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Departments\EmployeeDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class EmployeeDepartmentsToEmployee
 * @package App\Models\BaseModels\Pivots
 *
 * Мадель зависимости отдела к сотруднику
 */
class EmployeeDepartamentsToEmployee extends Model
{
    use HasFactory;

    protected  $fillable = [
        'employee_department_id',
        'employee_id',
        ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(EmployeeDepartment::class);
    }
}
