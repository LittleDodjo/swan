<?php

namespace App\Models\OutgoingModel;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OutgoingRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'stamps_used',
        'departure_data',
        'registration_number',
        'registration_date',
        'lists_count',
        'envelopes_count',
        'copies_count',
    ];

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function history(): BelongsTo
    {
        return $this->BelongsTo(OutgoingHistory::class);
    }

    public function departure(){

    }
}
