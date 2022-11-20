<?php

namespace App\Models\BaseModels\Employees;

use App\Models\BaseModels\Organization;
use App\Models\User;
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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function employeeDepency()
    {
        return $this->belongsTo(EmployeeDepency::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function employeeDefault()
    {
        return $this->hasOne(EmployeeDefaults::class);
    }

    public function isManager()
    {
        return $this->appointment->is_manager;
    }

    public function isPrimaryManager()
    {
        return $this->appointment->is_primary_manager;
    }

    public function isOnWork()
    {
        if ($this->employeeDefault == null) return true;
        if ($this->employeeDefault->reason->is_always) return false;
        if (date("Y-m-d") <= $this->employeeDefault->toDate) return false;
        return true;
    }

    public function isBusy(){
        return $this->user != null;
    }
}
