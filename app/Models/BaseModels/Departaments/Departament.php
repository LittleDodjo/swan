<?php

namespace App\Models\BaseModels\Departaments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;

    protected $fillable = [
        'managment_depends',
        'employee_manager_id',
        'employee_primary_manager_id',
        'caption',
        'short_name',
        'display_number',
    ];


}
