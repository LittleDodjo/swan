<?php

namespace App\Models\OutgoingModel;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutgoingHistory extends Model
{

    use HasFactory, SoftDeletes;

    protected $casts = [
        'touched_fields' => 'array',
    ];

    protected $fillable = [
        'outgoing_register_id',
        'employee_id',
        'touched_fields',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function outgoing(): HasOne
    {
        return $this->HasOne(OutgoingRegister::class);
    }
}
