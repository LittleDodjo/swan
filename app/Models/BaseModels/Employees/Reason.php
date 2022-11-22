<?php

namespace App\Models\BaseModels\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(mixed $validated)
 */
class Reason extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'is_always',
    ];
}
