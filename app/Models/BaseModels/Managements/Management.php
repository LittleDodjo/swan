<?php

namespace App\Models\BaseModels\Managements;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Pivots\DepartmentsToManagement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(mixed $management_id)
 */
class Management extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_depends_id',
        'employee_manager_id',
        'caption',
        'short_name'
    ];


    public function employeeDepends(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function employeeManager(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function departaments(): HasMany
    {
        return $this->hasMany(DepartmentsToManagement::class);
    }

}
