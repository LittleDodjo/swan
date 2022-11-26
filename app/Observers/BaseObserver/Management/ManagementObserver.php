<?php

namespace App\Observers\BaseObserver\Management;

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDependency;
use App\Models\BaseModel\Management\Management;
use App\Models\BaseModel\Pivot\DepartmentsToManagements;

class ManagementObserver
{

    /**
     * Handle the Management "created" event.
     *
     * @param Management $management
     * @return void
     */
    public function created(Management $management)
    {
        $management->manager->dependency->update([
            'employee_id' => $management->depends->id,
            'management_id' => $management->id,
        ]);
    }

    /**
     * Handle the Management "updated" event.
     *
     * @param Management $management
     * @return void
     */
    public function updated(Management $management)
    {
        if ($management->isDirty('depends_id')) {
            $management->manager->dependency->update(['employee_id' => $management->depends->id,]);
        }
        if ($management->isDirty('manager_id')) {
            $management->manager->dependency->update([
                'employee_id' => $management->depends->id,
                'management_id' => $management->id,
            ]);
            $employee = Employee::find($management->getOriginal('manager_id'));
            $employee->dependency->update([
                'employee_id' => null,
                'management_id' => null,
            ]);
            $dependencies = EmployeeDependency::where('management_id', $management->id)
                ->where('department_id', !null)
                ->update(['employee_id' => $management->manager->id]);
        }
    }

    /**
     * Handle the Management "deleted" event.
     *
     * @param Management $management
     * @return void
     */
    public function deleted(Management $management)
    {
        $management->manager->dependency->update([
            'employee_id' => null,
            'management_id' => null,
        ]);
        DepartmentsToManagements::destroy($management->departments);
    }

    /**
     * Handle the Management "restored" event.
     *
     * @param Management $management
     * @return void
     */
    public function restored(Management $management)
    {
        //
    }

    /**
     * Handle the Management "force deleted" event.
     *
     * @param Management $management
     * @return void
     */
    public function forceDeleted(Management $management)
    {
        //
    }
}
