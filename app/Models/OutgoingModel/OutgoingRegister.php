<?php

namespace App\Models\OutgoingModel;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property mixed employee_id
 * @property mixed stamps_used
 * @property mixed employee
 * @property mixed id
 * @property mixed history
 */
class OutgoingRegister extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'stamps_used' => 'array',
        'departure_data' => 'array',
    ];

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

    public function employee(): BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }

    public function history(): HasMany
    {
        return $this->HasMany(OutgoingHistory::class);
    }

    public function stamps(): Collection
    {
        return collect($this->stamps_used);
    }
}
