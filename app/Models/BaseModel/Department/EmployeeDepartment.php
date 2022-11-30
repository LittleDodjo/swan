<?php

namespace App\Models\BaseModel\Department;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $manager
 * @property mixed $depends
 * @property mixed $id
 * @property mixed $deputy
 * @method static find(mixed $employeeDepartmentDependency)
 */
class EmployeeDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_depends',
        'manager_id',
        'deputy_id',
        'caption',
        'code',
        'short_name',
    ];

    /**
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    /**
     * @return BelongsTo
     */
    public function deputy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'deputy_id');
    }

    /**
     * @return BelongsTo
     */
    public function depends(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_depends');
    }
}
