<?php

namespace App\Models\BaseModels;

use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AllDepartaments extends Pivot
{

    protected $fillable = [
        'departament_id',
        'employee_departament_id',
    ];


    public function departament(){
        return $this->hasOne(Departament::class);
    }

    public function employeeDepartament(){
        return $this->hasOne(EmployeeDepartament::class);
    }

}
