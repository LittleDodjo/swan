<?php

namespace App\Observers\BaseObserver\Employee;

use App\Models\BaseModels\Pivots\EmployeesToDepartment;

class EmployeesToDepartmentObserver
{
    /**
     * Handle the EmployeesToDepartment "created" event.
     *
     * @param  \App\Models\BaseModels\Pivots\EmployeesToDepartment  $employeesToDepartment
     * @return void
     */
    public function created(EmployeesToDepartment $employeesToDepartment)
    {
        $employeesToDepartment->employeeDependency()->delete();
    }

    /**
     * Handle the EmployeesToDepartment "updated" event.
     *
     * @param  \App\Models\BaseModels\Pivots\EmployeesToDepartment  $employeesToDepartment
     * @return void
     */
    public function updated(EmployeesToDepartment $employeesToDepartment)
    {
        throw new \Exception("IDI V ZHOPY");
        $employeesToDepartment->employeeDependency()->delete();
    }

    /**
     * Handle the EmployeesToDepartment "deleted" event.
     *
     * @param  \App\Models\BaseModels\Pivots\EmployeesToDepartment  $employeesToDepartment
     * @return void
     */
    public function deleted(EmployeesToDepartment $employeesToDepartment)
    {
        throw new \Exception("IDI V ZHOPY");
        $employeesToDepartment->employeeDependency()->update(['department_id' => 1]);
    }

    /**
     * Handle the EmployeesToDepartment "restored" event.
     *
     * @param  \App\Models\BaseModels\Pivots\EmployeesToDepartment  $employeesToDepartment
     * @return void
     */
    public function restored(EmployeesToDepartment $employeesToDepartment)
    {
        throw new \Exception("IDI V ZHOPY");
        $employeesToDepartment->employeeDependency()->delete();
    }

    /**
     * Handle the EmployeesToDepartment "force deleted" event.
     *
     * @param  \App\Models\BaseModels\Pivots\EmployeesToDepartment  $employeesToDepartment
     * @return void
     */
    public function forceDeleted(EmployeesToDepartment $employeesToDepartment)
    {
        throw new \Exception("IDI V ZHOPY");
        $employeesToDepartment->employeeDependency()->delete();
    }
}
