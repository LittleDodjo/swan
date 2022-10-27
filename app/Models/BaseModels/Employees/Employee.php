<?php

namespace App\Models\BaseModels\Employees;

use App\Models\BaseModels\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'patronymic',
        'phone_number',
        'appointment_id',
        'employee_depency_id',
        'user_id',
        'email',
        'personal_data_access',
    ];


    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function employeeDepency(){
        return $this->hasOne(EmployeeDepency::class);
    }

    public function appointment(){
        return $this->hasOne(Appointment::class);
    }

}
