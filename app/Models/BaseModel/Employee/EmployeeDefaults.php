<?php

namespace App\Models\BaseModel\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\Pure;

/**
 * @method isAlways()
 * @property mixed $reason
 * @property mixed from_date
 * @property mixed to_date
 */
class EmployeeDefaults extends Model
{
    use HasFactory;


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
    public function deputy(): BelongsTo
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
     * @return bool
     */
    #[Pure] public function active(): bool
    {
        return $this->always() || ($this->from_date < $this->to_date);
    }

    /**
     * Получить статус навсегда-ли отсутствие сотрудника
     * @return boolean
     */
    public function always(): bool
    {
        if($this->reason == null) return false;
        return $this->reason->is_always;
    }
}
