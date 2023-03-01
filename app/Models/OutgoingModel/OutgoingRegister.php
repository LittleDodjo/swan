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
use Illuminate\Support\Facades\Log;

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
        'message_type',
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
        if (Arr::exists($departure, 'organization')) {
            $departure['type'] = 'organization';
            $departure[$departure['type']] =
                new OrganizationRegisterResource(OrganizationRegister::find($this->departure_data[$departure['type']]['address']));
        }
        if (Arr::exists($departure, 'people')) {
            $departure['type'] = 'people';
            $departure[$departure['type']]['name'] = $this->departure_data[$departure['type']]['name'];
            $departure[$departure['type']]['address'] = $this->departure_data[$departure['type']]['address'];
        }
        if (Arr::exists($departure, 'mail')) {
            $departure['type'] = 'mail';
            $departure[$departure['type']]['address'] = $this->departure_data[$departure['type']]['address'];
        }
        $departure['date'] = $this->departure_data[$departure['type']]['date'];
        return $departure;
    }

    public function employee(): BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }

    /**
     * @return BelongsTo
     */
    public function executor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'executor_id');
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
