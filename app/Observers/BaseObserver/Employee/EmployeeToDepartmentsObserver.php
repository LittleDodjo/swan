<?php

namespace App\Observers\BaseObserver\Employee;

use App\Models\BaseModel\Pivot\EmployeesToDepartments;

class EmployeeToDepartmentsObserver
{

    /**
     * Handle the EmployeesToDepartments "created" event.
     *
     * @param EmployeesToDepartments $employeesToDepartments
     * @return void
     */
    public function created(EmployeesToDepartments $employeesToDepartments)
    {
        $department = $employeesToDepartments->department;
        $employee = $employeesToDepartments->employee;
        if($employee->is($department->manager) || $employee->is($department->deputy)){
            $employee->dependency->update([
                'department_id' => $department->id,
            ]);
        }else{
            $employee->dependency->update([
                'department_id' => $department->id,
                'employee_id' => $department->manager->id,
            ]);
        }
    }

    /**
     * Handle the EmployeesToDepartments "updated" event.
     *
     * @param EmployeesToDepartments $employeesToDepartments
     * @return void
     */
    public function updated(EmployeesToDepartments $employeesToDepartments)
    {
        //
    }

    /**
     * Handle the EmployeesToDepartments "deleted" event.
     *
     * @param EmployeesToDepartments $employeesToDepartments
     * @return void
     */
    public function deleted(EmployeesToDepartments $employeesToDepartments)
    {
        $employee = $employeesToDepartments->employee;
        $employee->dependency->update([
            'department_id' => null,
            'management_id' => null,
            'employee_id' => null,
        ]);
    }

    /**
     * Handle the EmployeesToDepartments "restored" event.
     *
     * @param EmployeesToDepartments $employeesToDepartments
     * @return void
     */
    public function restored(EmployeesToDepartments $employeesToDepartments)
    {
        //
    }

    /**
     * Handle the EmployeesToDepartments "force deleted" event.
     *
     * @param EmployeesToDepartments $employeesToDepartments
     * @return void
     */
    public function forceDeleted(EmployeesToDepartments $employeesToDepartments)
    {
        //
    }
}
