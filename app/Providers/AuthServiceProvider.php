<?php

namespace App\Providers;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Employee\Appointment;
use App\Models\BaseModel\Employee\EmployeeDefaults;
use App\Models\BaseModel\Employee\Reason;
use App\Models\BaseModel\Management\Management;
use App\Models\BaseModel\Organization;
use App\Policies\BasePolicy\Department\DepartmentPolicy;
use App\Policies\BasePolicy\Department\EmployeeDepartmentPolicy;
use App\Policies\BasePolicy\Employee\AppointmentPolicy;
use App\Policies\BasePolicy\Employee\DefaultPolicy;
use App\Policies\BasePolicy\Employee\EmployeeDefaultsPolicy;
use App\Policies\BasePolicy\Employee\ReasonPolicy;
use App\Policies\BasePolicy\Management\ManagementPolicy;
use App\Policies\BasePolicy\OrganizationPolicy;
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
        Reason::class => ReasonPolicy::class,
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
