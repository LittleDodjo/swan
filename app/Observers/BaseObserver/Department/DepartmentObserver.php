<?php

namespace App\Observers\BaseObserver\Department;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDependency;
use App\Models\BaseModel\Pivot\AllDepartment;
use App\Models\BaseModel\Pivot\DepartmentsToManagements;
use App\Models\BaseModel\Pivot\EmployeesToDepartments;

class DepartmentObserver
{
    /**
     * Handle the Department "created" event.
     *
     * @param Department $department
     * @return void
     */
    public function created(Department $department)
    {
        $department->manager->dependency->update([
            'employee_id' => $department->management->manager->id,
            'department_id' => $department->id,
            'management_id' => $department->management_id,
        ]);
        EmployeesToDepartments::create([
            'employee_id' => $department->manager->id,
            'department_id' => $department->id,
        ]);
        if ($department->deputy != null) {
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
     * @param Department $department
     * @return void
     */
    public function updated(Department $department)
    {
        if ($department->isDirty('management_id')) {
            DepartmentsToManagements::where('department_id', $department->id)
                ->update(['management_id', $department->management->id]);
        }
        if ($department->isDirty('deputy_id')) {
            $employee = Employee::find($department->getOriginal('deputy_id'));
            EmployeesToDepartments::where('department_id', $department->id)
                ->where('employee_id', $employee->id)->update([
                    'employee_id' => $department->deputy->id,
                ]);
            $department->deputy->dependency->update([
                'employee_id' => $department->manager->id,
                'department_id' => $department->id,
            ]);
            $employee->dependency->update([
                'employee_id' => null,
                'department_id' => null,
            ]);
        }
        if ($department->isDirty('manager_id')) {
            $department->manager->dependency->update([
                'employee_id' => $department->management->manager->id,
                'management_id' => $department->management->id,
                'department_id' => $department->id,
            ]);
            $employee = Employee::find($department->getOriginal('manager_id'));
            EmployeesToDepartments::where('department_id', $department->id)
                ->where('employee_id', $employee->id)->update([
                    'employee_id' => $department->manager->id,
                ]);
            EmployeeDependency::where('department_id', $department->id)
                ->where('employee_id', $employee->id)
                ->update(['employee_id' => $department->manager->id]);
            $employee->dependency->update([
                'employee_id' => null,
                'management_id' => null,
                'department_id' => null,
            ]);
        }
    }

    /**
     * Handle the Department "deleted" event.
     *
     * @param Department $department
     * @return void
     */
    public function deleted(Department $department)
    {
        EmployeeDependency::where('department_id', $department->id)->update([
            'employee_id' => null,
            'department_id' => null,
            'management_id' => null,
        ]);
        AllDepartment::where('department_id', $department->id)->delete();
        EmployeesToDepartments::where('department_id', $department->id)->delete();
        DepartmentsToManagements::where('department_id', $department->id)->delete();
    }

    /**
     * Handle the Department "restored" event.
     *
     * @param Department $department
     * @return void
     */
    public function restored(Department $department)
    {
        //
    }

    /**
     * Handle the Department "force deleted" event.
     *
     * @param Department $department
     * @return void
     */
    public function forceDeleted(Department $department)
    {
        //
    }
}
