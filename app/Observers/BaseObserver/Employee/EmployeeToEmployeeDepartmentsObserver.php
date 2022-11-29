<?php

namespace App\Observers\BaseObserver\Employee;

use App\Models\BaseModel\Pivot\EmployeesToEmployeeDepartments;

class EmployeeToEmployeeDepartmentsObserver
{
    /**
     * Handle the EmployeesToEmployeeDepartments "created" event.
     *
     * @param EmployeesToEmployeeDepartments $employeesToEmployeeDepartments
     * @return void
     */
    public function created(EmployeesToEmployeeDepartments $employeesToEmployeeDepartments)
    {
        $department = $employeesToEmployeeDepartments->department;
        $employee = $employeesToEmployeeDepartments->employee;
        if ($employee->is($department->manager) || $employee->is($department->deputy)) {
            $employee->dependency->update([
                'employee_department_id' => $department->id,
            ]);
        } else {
            $employee->dependency->update([
                'employee_department_id' => $department->id,
                'employee_id' => $department->manager->id,
            ]);
        }
    }

    /**
     * Handle the EmployeesToEmployeeDepartments "updated" event.
     *
     * @param EmployeesToEmployeeDepartments $employeesToEmployeeDepartments
     * @return void
     */
    public function updated(EmployeesToEmployeeDepartments $employeesToEmployeeDepartments)
    {
        //
    }

    /**
     * Handle the EmployeesToEmployeeDepartments "deleted" event.
     *
     * @param EmployeesToEmployeeDepartments $employeesToEmployeeDepartments
     * @return void
     */
    public function deleted(EmployeesToEmployeeDepartments $employeesToEmployeeDepartments)
    {
        $employee = $employeesToEmployeeDepartments->employee;
        $employee->dependency->update([
            'employee_department_id' => null,
            'department_id' => null,
            'management_id' => null,
            'employee_id' => null,
        ]);
    }

    /**
     * Handle the EmployeesToEmployeeDepartments "restored" event.
     *
     * @param EmployeesToEmployeeDepartments $employeesToEmployeeDepartments
     * @return void
     */
    public function restored(EmployeesToEmployeeDepartments $employeesToEmployeeDepartments)
    {
        //
    }

    /**
     * Handle the EmployeesToEmployeeDepartments "force deleted" event.
     *
     * @param EmployeesToEmployeeDepartments $employeesToEmployeeDepartments
     * @return void
     */
    public function forceDeleted(EmployeesToEmployeeDepartments $employeesToEmployeeDepartments)
    {
        //
    }
}
