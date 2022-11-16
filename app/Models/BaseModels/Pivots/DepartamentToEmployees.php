<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartamentToEmployees extends Pivot
{

    protected $fillable = [
        'employee_id',
        'departament_id',
    ];


    public function employees(){
        return $this->hasMany(Employee::class);
    }


}
