<?php

namespace App\Models\Subsystem\Outgoing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutDocHistory extends Model
{
    use HasFactory;

    protected $table = 'outgoing_history';

    protected $fillable = [
        'user_id',
        'document_id',
        'actions',

    ];

}
