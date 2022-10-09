<?php

namespace App\Models\Subsystem\Outgoing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutUsersRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'isView',
        'isViewAny',
        'isCreate',
        'isDelete',
        'isChange',
    ];


}
