<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @property bool is_root
 */
class UserRoles extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_root',
        'is_admin',
        'is_control_manager'
    ];
}
