<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_root',
        'is_admin',
        'is_control',
        'outgoing_manager',
        'incoming_manager',
    ];
}
