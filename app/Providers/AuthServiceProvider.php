<?php

namespace App\Providers;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Employee\Appointment;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDefaults;
use App\Models\BaseModel\Employee\Reason;
use App\Models\BaseModel\Management\Management;
use App\Models\BaseModel\Organization;
use App\Models\OutgoingModel\OrganizationRegister;
use App\Models\OutgoingModel\OutgoingRegister;
use App\Models\OutgoingModel\Stamps\StampRegister;
use App\Policies\BasePolicy\Department\DepartmentPolicy;
use App\Policies\BasePolicy\Department\EmployeeDepartmentPolicy;
use App\Policies\BasePolicy\Employee\AppointmentPolicy;
use App\Policies\BasePolicy\Employee\EmployeeDefaultsPolicy;
use App\Policies\BasePolicy\Employee\EmployeePolicy;
use App\Policies\BasePolicy\Employee\ReasonPolicy;
use App\Policies\BasePolicy\Management\ManagementPolicy;
use App\Policies\BasePolicy\OrganizationPolicy;
use App\Policies\OutgoingPolicy\OrganizationRegisterPolicy;
use App\Policies\OutgoingPolicy\OutgoingRegisterPolicy;
use App\Policies\OutgoingPolicy\Stamps\StampRegisterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Management::class => ManagementPolicy::class,
        Department::class => DepartmentPolicy::class,
        EmployeeDepartment::class => EmployeeDepartmentPolicy::class,
        Organization::class => OrganizationPolicy::class,
        EmployeeDefaults::class => EmployeeDefaultsPolicy::class,
        Appointment::class => AppointmentPolicy::class,
        Employee::class => EmployeePolicy::class,
        Reason::class => ReasonPolicy::class,
        StampRegister::class => StampRegisterPolicy::class,
        OrganizationRegister::class => OrganizationRegisterPolicy::class,
        OutgoingRegister::class => OutgoingRegisterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
