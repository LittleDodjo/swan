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
        'reason_id',
        'fromDate',
        'toDate',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function deputyEmployee(){
        return $this->belongsTo(Employee::class, 'deputy_employee_id');
    }

    public function reason(){
        return $this->belongsTo(Reason::class);
    }
}
