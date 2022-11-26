<?php

namespace App\Observers\BaseObserver\Department;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Pivot\AllDepartment;
use App\Models\BaseModel\Pivot\DepartmentsToManagements;
use App\Models\BaseModel\Pivot\EmployeesToDepartments;

class DepartmentObserver
{
    /**
     * Handle the Department "created" event.
     *
     * @param  \App\Models\BaseModel\Department\Department  $department
     * @return void
     */
    public function created(Department $department)
    {
//        throw new \Exception($department->management->id);
        $department->manager->dependency->update([
            'employee_id' => $department->management->manager->id,
            'department_id' => $department->id,
            'management_id' => $department->management_id,
        ]);
        EmployeesToDepartments::create([
            'employee_id' => $department->manager->id,
            'department_id' => $department->id,
        ]);
        if($department->deputy != null){
            $department->deputy->dependency->update([
                'employee_id' => $department->manager->id,
                'department_id' => $department->id,
            ]);
            EmployeesToDepartments::create([
                'employee_id' => $department->deputy->id,
                'department_id' => $department->id,
            ]);
        }
        AllDepartment::create(['department_id' => $department->id]);
        DepartmentsToManagements::create([
            'management_id' => $department->management_id,
            'department_id' => $department->id,
        ]);
    }

    /**
     * Handle the Department "updated" event.
     *
     * @param  \App\Models\BaseModel\Department\Department  $department
     * @return void
     */
    public function updated(Department $department)
    {
        //
    }

    /**
     * Handle the Department "deleted" event.
     *
     * @param  \App\Models\BaseModel\Department\Department  $department
     * @return void
     */
    public function deleted(Department $department)
    {
        //
    }

    /**
     * Handle the Department "restored" event.
     *
     * @param  \App\Models\BaseModel\Department\Department  $department
     * @return void
     */
    public function restored(Department $department)
    {
        //
    }

    /**
     * Handle the Department "force deleted" event.
     *
     * @param  \App\Models\BaseModel\Department\Department  $department
     * @return void
     */
    public function forceDeleted(Department $department)
    {
        //
    }
}
