<?php

namespace App\Models\Outgoing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationRegister extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'index',
        'city',
        'street',
        'number',
        'name',
    ];
}
