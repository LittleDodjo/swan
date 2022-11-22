<?php

namespace App\Models\BaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(mixed $validated)
 */
class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
    ];

}
