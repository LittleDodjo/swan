<?php

namespace App\Models\OutgoingModel\Stamps;

use App\Models\OutgoingModel\OutgoingRegister;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StampHistory extends Model
{

    use HasFactory;

    protected $casts = [
        'stamps_used' => 'array',
    ];

    protected $fillable = [
        'outgoing_register_id',
        'stamps_used',
    ];

    public function outgoing()
    {
        $this->belongsTo(OutgoingRegister::class, 'outgoing_register_id');
    }
}
