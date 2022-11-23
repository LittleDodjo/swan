<?php

namespace App\Models\BaseModels\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(mixed $validated)
 * @property mixed id
 * @property boolean is_always
 */
class Reason extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'is_always',
    ];
}
