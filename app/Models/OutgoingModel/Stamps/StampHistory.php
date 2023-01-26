<?php

namespace App\Models\OutgoingModel\Stamps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
