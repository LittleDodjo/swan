<?php

namespace App\Models\BaseModels\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDefaults extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'deputy_employee_id',
        'fromDate',
        'toDate',
        'is_always',
    ];

    public function employee(){
        return $this->hasOne(Employee::class);
    }

    public function deputyEmployee(){
        return $this->hasOne(Employee::class);
    }
}
