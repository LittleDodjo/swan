<?php

namespace App\Models\OutgoingModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingHistory extends Model
{

    protected $fillable = [
        'outgoing_registers_id',
        'employee_id',
        'touched_fields',
    ];

    use HasFactory;
}
