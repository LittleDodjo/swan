<?php

namespace App\Providers;

use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Pivots\EmployeesToDepartment;
use App\Observers\BaseObserver\Department\DepartmentObserver;
use App\Observers\BaseObserver\Employee\EmployeeObserver;
use App\Observers\BaseObserver\Employee\EmployeesToDepartmentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Department::observe(DepartmentObserver::class);
        Employee::observe(EmployeeObserver::class);
        EmployeesToDepartment::observe(EmployeesToDepartmentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
