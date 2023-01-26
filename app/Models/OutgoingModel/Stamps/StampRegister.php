<?php

namespace App\Models\OutgoingModel\Stamps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $id
 * @property mixed count
 */
class StampRegister extends Model
{
    use HasFactory, SoftDeletes;



    protected $fillable = [
        'value',
        'count',
    ];

}
