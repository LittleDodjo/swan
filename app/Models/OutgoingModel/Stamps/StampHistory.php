<?php

namespace App\Models\OutgoingModel\Stamps;

use App\Models\OutgoingModel\OutgoingRegister;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed stamps
 */
class StampHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'stamps' => 'array',
    ];

    protected $fillable = [
        'outgoing_register_id',
        'type',
        'stamps',
    ];

    public function getCreatedAtAttribute($date): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y.m.d');
    }

    public function document(): BelongsTo
    {
        return $this->BelongsTo(OutgoingRegister::class, 'outgoing_register_id');
    }
}
