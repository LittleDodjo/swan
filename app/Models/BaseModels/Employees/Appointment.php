<?php

namespace App\Models\BaseModels\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'short_name',
        'is_manager',
        'is_primary_manager',
    ];
}
