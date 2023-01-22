<?php

namespace App\Models\OutgoingModel\Stamps;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $employee
 * @property mixed $type
 * @property mixed $balance
 * @property mixed $employee_id
 */
class StampBalance extends Model
{

    use HasFactory;

    protected $casts = [
        'balance' => 'array',
    ];

    protected $fillable = [
        'employee_id',
        'type',
        'balance',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
