<?php

namespace App\Models\BaseModels\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed reason
 */
class EmployeeDefaults extends Model
{
    use HasFactory;

    /**
     * Данные
     * @var string[]
     */
    protected $fillable = [
        'employee_id',
        'deputy_employee_id',
        'reason_id',
        'from_date',
        'to_date',
    ];

    /**
     * Сотрудник, который отсутствует (связь один к одному)
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Связь один к одному, замещающий сотрудник
     * @return BelongsTo
     */
    public function deputyEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'deputy_employee_id');
    }

    /**
     * Получить причину отсутствия (связь один к одному)
     * @return BelongsTo
     */
    public function reason(): BelongsTo
    {
        return $this->belongsTo(Reason::class);
    }


    /**
     * Получить статус навсегда-ли отсутствие сотрудника
     * @return boolean
     */
    public function isAlways(): bool
    {
        if($this->reason == null) return false;
        return $this->reason->is_always;
    }
}
