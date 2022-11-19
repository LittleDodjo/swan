<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Departaments\EmployeeDepartament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeDepartamentsToEmployee
 * @package App\Models\BaseModels\Pivots
 *
 * Мадель зависимости отдела к сотруднику
 */
class EmployeeDepartamentsToEmployee extends Model
{
    use HasFactory;

    protected  $fillable = [
        'employee_departament_id',
        'employee_id',
        ];

    public function departament(){
        return $this->belongsTo(EmployeeDepartament::class);
    }
}
