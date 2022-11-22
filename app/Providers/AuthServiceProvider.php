<?php

namespace App\Providers;

use App\Models\BaseModels\Employees\Appointment;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDefaults;
use App\Models\BaseModels\Employees\EmployeeDepency;
use App\Models\BaseModels\Employees\Reason;
use App\Models\BaseModels\Organization;
use App\Models\UserRoles;
use App\Policies\Api\BasePolicy\Employee\AppointmentPolicy;
use App\Policies\Api\BasePolicy\Employee\EmployeeDefaultsPolicy;
use App\Policies\Api\BasePolicy\Employee\EmployeeDepencyPolicy;
use App\Policies\Api\BasePolicy\Employee\EmployeePolicy;
use App\Policies\Api\BasePolicy\Employee\ReasonPolicy;
use App\Policies\Api\BasePolicy\OrganizationPolicy;
use App\Policies\Api\BasePolicy\User\UserRolesPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        UserRoles::class => UserRolesPolicy::class,
        Organization::class => OrganizationPolicy::class,
        Reason::class => ReasonPolicy::class,
        Appointment::class => AppointmentPolicy::class,
        EmployeeDefaults::class => EmployeeDefaultsPolicy::class,
        Employee::class => EmployeePolicy::class,
        EmployeeDepency::class => EmployeeDepencyPolicy::class,
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
