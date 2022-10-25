<?php

namespace App\Models\BaseModels\Employees;

use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use App\Models\BaseModels\Managments\Managment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepency extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'managment_id',
        'departament_id',
        'employee_departament_id',
    ];

    public function employeeDepency(){
        return $this->hasOne(Employee::class);
    }

    public function managmentDepency(){
        return $this->hasOne(Managment::class);
    }

    public function departamentDepency(){
        return $this->hasOne(Departament::class);
    }

    public function employeeDepartamentDepency(){
        return $this->hasOne(EmployeeDepartament::class);
    }
}
