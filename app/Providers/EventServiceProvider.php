<?php

namespace App\Providers;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Management\Management;
use App\Models\BaseModel\Pivot\EmployeesToDepartments;
use App\Models\BaseModel\Pivot\EmployeeToEmployeeDepartments;
use App\Models\OutgoingModel\OutgoingRegister;
use App\Models\OutgoingModel\Stamps\StampRegister;
use App\Observers\BaseObserver\Department\DepartmentObserver;
use App\Observers\BaseObserver\Department\EmployeeDepartmentObserver;
use App\Observers\BaseObserver\Employee\EmployeeToDepartmentsObserver;
use App\Observers\BaseObserver\Employee\EmployeeToEmployeeDepartmentsObserver;
use App\Observers\BaseObserver\Management\ManagementObserver;
use App\Observers\OutgoingObserver\OutgoingRegisterObserver;
use App\Observers\OutgoingObserver\Stamps\StampRegisterObserver;
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
        Management::observe(ManagementObserver::class);
        Department::observe(DepartmentObserver::class);
        EmployeeDepartment::observe(EmployeeDepartmentObserver::class);
        EmployeesToDepartments::observe(EmployeeToDepartmentsObserver::class);
        EmployeeToEmployeeDepartments::observe(EmployeeToEmployeeDepartmentsObserver::class);
        OutgoingRegister::observe(OutgoingRegisterObserver::class);
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
