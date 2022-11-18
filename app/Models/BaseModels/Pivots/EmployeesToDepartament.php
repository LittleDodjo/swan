<?php

namespace App\Models\BaseModels\Pivots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeesToDepartament
 * @package App\Models\BaseModels\Pivots
 * Модель сотрудников отдела
 */
class EmployeesToDepartament extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'departament_id',
    ];
}
