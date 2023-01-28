<?php

namespace App\Models\OutgoingModel;

use App\Http\Resources\OutgoingResource\OrganizationRegisterResource;
use App\Http\Resources\OutgoingResource\Stamps\StampRegisterResource;
use App\Models\BaseModel\Employee\Employee;
use App\Models\OutgoingModel\Stamps\StampHistory;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * @property mixed employee_id
 * @property mixed stamps_used
 * @property mixed employee
 * @property mixed id
 * @property mixed history
 * @property mixed stampHistory
 * @property mixed $departure_data
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
        'executor_id',
        'stamps_used',
        'departure_data',
        'registration_number',
        'registration_date',
        'lists_count',
        'envelopes_count',
        'copies_count',
    ];

    public function getCreatedAtAttribute($date): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y.m.d');
    }

    public function getUpdatedAtAttribute($date): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    /**
     * @return array
     */
    public function used(): array
    {
        $stamps = [];
        foreach ($this->stamps_used as $key => $value) {
            $stamp = StampRegister::find($value['id']);
            $stamps[] = [
                'id' => $stamp->id,
                'value' => $stamp->value,
                'used' => $value['count'],
            ];
        }
        $totalCount = 0;
        $totalPrice = 0;
        foreach ($stamps as $key => $value) {
            $totalCount += $value['used'];
            $totalPrice += $value['used'] * $value['value'];
        }
        $stamps['total'] = $totalCount;
        $stamps['price'] = $totalPrice;
        return $stamps;
    }

    public function departure()
    {
        $departure = $this->departure_data;
        if (count($departure) == 1) {
            $departure['equals'] = true;
            $departure['total'] = 1;
        }
        $equals = true;
        $total = 0;
        $prevDate = Arr::first($departure)['date'];
        foreach ($departure as $key => $value) {
            if ($prevDate != $value['date']) $equals = false;
            if ($key == 'organization') {
                $departure['organization']['address'] = new OrganizationRegisterResource(
                    OrganizationRegister::find($departure['organization']['address'])
                );
            }
            $prevDate = $value['date'];
            $total++;
        }
        $departure['equals'] = $equals;
        $departure['total'] = $total;
        return $departure;
    }

    public function employee(): BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }

    public function executor()
    {
        $this->belongsTo(Employee::class, 'executor_id');
    }

    public function history(): HasMany
    {
        return $this->HasMany(OutgoingHistory::class);
    }

    public function stamps(): Collection
    {
        return collect($this->stamps_used);
    }

    public function stampHistory(): HasOne
    {
        return $this->hasOne(StampHistory::class);
    }
}
