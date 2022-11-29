<?php

namespace App\Models\BaseModel\Pivot;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed department
 * @property mixed employee
 */
class EmployeesToDepartments extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
    ];

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
