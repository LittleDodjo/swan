<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Departaments\Departament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentsToManagment extends Model
{
    use HasFactory;


    protected $fillable = [
        'departament_id',
        'managment_id',
    ];

}
