<?php

namespace App\Observers\BaseObserver\Department;

use App\Models\BaseModels\Departments\Department;

class DepartmentObserver
{
    public bool $afterCommit = true;

    /**
     * Handle the Department "created" event.
     *
     * @param  \App\Models\BaseModels\Departments\Department  $department
     * @return void
     */
    public function created(Department $department)
    {

    }

    /**
     * Handle the Department "updated" event.
     *
     * @param  \App\Models\BaseModels\Departments\Department  $department
     * @return void
     */
    public function updated(Department $department)
    {
        //
    }

    /**
     * Handle the Department "deleted" event.
     *
     * @param  \App\Models\BaseModels\Departments\Department  $mdep
     * @return void
     */
    public function deleted(Department $mdep)
    {
        $mdep->employees()->delete();
    }
}
