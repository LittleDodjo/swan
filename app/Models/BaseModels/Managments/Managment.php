<?php

namespace App\Models\BaseModels\Managments;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Pivots\DepartamentsToManagment;
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
        return $this->belongsTo(Employee::class);
    }

    public function employeeManager(){
        return $this->belongsTo(Employee::class);
    }

    public function departaments(){
        return $this->hasMany(DepartamentsToManagment::class);
    }

}
