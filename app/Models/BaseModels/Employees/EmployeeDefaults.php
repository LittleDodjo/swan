<?php

namespace App\Models\BaseModels\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'fromDate',
        'toDate',
    ];

    /**
     * Сотрудник, который отсутствует (связь один к одному)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Связь один к одному, замещающий сотрудник
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deputyEmployee()
    {
        return $this->belongsTo(Employee::class, 'deputy_employee_id');
    }

    /**
     * Получить причину отсутствия (связь один к одному)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }


    /**
     * Получить статус навсегда-ли отсутствие сотрудника
     * @return boolean
     */
    public function isAlways()
    {
        if($this->reason == null) return false;
        return $this->reason->is_always;
    }
}
