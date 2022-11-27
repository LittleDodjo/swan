<?php

namespace App\Models\BaseModel\Management;

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Pivot\DepartmentsToManagements;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(mixed $management_id)
 * @method static create(mixed $validated)
 * @property mixed id
 * @property mixed employee_manager_id
 * @property mixed departments
 * @property mixed $manager
 * @property mixed $depends
 */
class Management extends Model
{
    use HasFactory;

    protected $table = 'managements';

    protected $fillable = [
        'depends_id',
        'manager_id',
        'caption',
        'short_name'
    ];

    /**
     * Возвращает сотрудника от которого зависит управление
     * @return BelongsTo
     */
    public function depends(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'depends_id', 'id');
    }

    /**
     * Возвращает руководителя управления
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(DepartmentsToManagements::class);
    }
}
