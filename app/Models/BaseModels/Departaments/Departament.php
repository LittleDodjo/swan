<?php

namespace App\Models\BaseModels\Departaments;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
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

    public function managmentDepends(){
        return $this->hasOne(Managment::class);
    }

    public function employeeManager(){
        return $this->hasOne(Employee::class);
    }

    public function employeePrimaryManager(){
        return $this->hasOne(Employee::class);
    }

}
