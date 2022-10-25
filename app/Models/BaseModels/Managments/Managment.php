<?php

namespace App\Models\BaseModels\Managments;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_depends_id',
        'employee_manager_id',
        'caption',
        'short_name'
    ];


    public function employeeDepends(){
        return $this->hasOne(Employee::class);
    }

    public function employeeManager(){
        return $this->hasOne(Employee::class);
    }

}
