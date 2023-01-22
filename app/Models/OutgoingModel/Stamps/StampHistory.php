<?php

namespace App\Models\OutgoingModel\Stamps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StampHistory extends Model
{

    protected $fillable = [
        'outgoing_registers_id',
        'stamps_used',
    ];

    use HasFactory;
}
