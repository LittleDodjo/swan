<?php

namespace App\Models\Outgoing\Stamps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StampRegister extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'value'
    ];
}
