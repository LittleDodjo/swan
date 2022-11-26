<?php

namespace App\Models\BaseModel\Department;

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDependency;
use App\Models\BaseModel\Management\Management;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed $manager
 * @property mixed $management
 * @property mixed $id
 * @property mixed $management_id
 * @property mixed $deputy
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'management_id',
        'manager_id',
        'deputy_id',
        'caption',
        'short_name',
        'code',
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
    public function management(): BelongsTo
    {
        return $this->belongsTo(Management::class, 'management_id');
    }
}
