<?php

namespace App\Providers;

use App\Models\BaseModels\Employees\Appointment;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDefaults;
use App\Models\BaseModels\Employees\EmployeeDependency;
use App\Models\BaseModels\Employees\Reason;
use App\Models\BaseModels\Managements\Management;
use App\Models\BaseModels\Organization;
use App\Models\User;
use App\Policies\Api\BasePolicy\Employee\AppointmentPolicy;
use App\Policies\Api\BasePolicy\Employee\EmployeeDefaultsPolicy;
use App\Policies\Api\BasePolicy\Employee\EmployeeDependencyPolicy;
use App\Policies\Api\BasePolicy\Employee\EmployeePolicy;
use App\Policies\Api\BasePolicy\Employee\ReasonPolicy;
use App\Policies\Api\BasePolicy\Management\ManagementPolicy;
use App\Policies\Api\BasePolicy\OrganizationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Organization::class => OrganizationPolicy::class,
        Reason::class => ReasonPolicy::class,
        Appointment::class => AppointmentPolicy::class,
        EmployeeDefaults::class => EmployeeDefaultsPolicy::class,
        Employee::class => EmployeePolicy::class,
        EmployeeDependency::class => EmployeeDependencyPolicy::class,
        Management::class => ManagementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-role', fn(User $user) => $user->isRoot());
        Gate::define('confirm-user', fn(User $user) => $user->isAdmin() || $user->isRoot());
    }
}
