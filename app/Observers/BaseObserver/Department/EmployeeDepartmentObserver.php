<?php

namespace App\Observers\BaseObserver\Department;

use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDependency;
use App\Models\BaseModel\Pivot\AllDepartment;
use App\Models\BaseModel\Pivot\EmployeesToEmployeeDepartments;
use App\Models\BaseModel\Pivot\EmployeeToEmployeeDepartments;

class EmployeeDepartmentObserver
{
    /**
     * Handle the EmployeeDepartment "created" event.
     *
     * @param EmployeeDepartment $employeeDepartment
     * @return void
     */
    public function created(EmployeeDepartment $employeeDepartment)
    {
        $employeeDepartment->manager->dependency->update([
            'employee_id' => $employeeDepartment->depends->id,
            'employee_department_id' => $employeeDepartment->id,
        ]);
        EmployeesToEmployeeDepartments::create([
            'employee_id' => $employeeDepartment->manager->id,
            'employee_department_id' => $employeeDepartment->id,
        ]);
        if ($employeeDepartment->deputy != null) {
            $employeeDepartment->deputy->dependency->update([
                'employee_id' => $employeeDepartment->manager->id,
                'employee_department_id' => $employeeDepartment->id,
            ]);
            EmployeesToEmployeeDepartments::create([
                'employee_id' => $employeeDepartment->deputy->id,
                'employee_department_id' => $employeeDepartment->id,
            ]);
        }
        AllDepartment::create(['employee_department_id' => $employeeDepartment->id]);
        EmployeeToEmployeeDepartments::create([
            'employee_id' => $employeeDepartment->depends->id,
            'employee_department_id' => $employeeDepartment->id,
        ]);
    }

    /**
     * Handle the EmployeeDepartment "updated" event.
     *
     * @param EmployeeDepartment $employeeDepartment
     * @return void
     */
    public function updated(EmployeeDepartment $employeeDepartment)
    {
        if ($employeeDepartment->isDirty('employee_depends')) {
            EmployeeToEmployeeDepartments::where('employee_department_id', $employeeDepartment->id)
                ->update(['employee_id' => $employeeDepartment->depends->id]);
        }
        if ($employeeDepartment->isDirty('deputy_id')) {
            $employee = Employee::find($employeeDepartment->getOriginal('deputy_id'));
            EmployeesToEmployeeDepartments::where('employee_department_id', $employeeDepartment->id)
                ->where('employee_id', $employee->id)->update([
                    'employee_id' => $employeeDepartment->deputy->id,
                ]);
            $employeeDepartment->deputy->dependency->update([
                'employee_id' => $employeeDepartment->manager->id,
                'employee_department_id' => $employeeDepartment->id,
            ]);
            $employee->dependency->update([
                'employee_id' => null,
                'employee_department_id' => null,
            ]);
        }
        if ($employeeDepartment->isDirty('manager_id')) {
            $employeeDepartment->manager->dependency->update([
                'employee_id' => $employeeDepartment->depends->id,
                'employee_department_id' => $employeeDepartment->id,
            ]);
            $employee = Employee::find($employeeDepartment->getOriginal('manager_id'));
            EmployeesToEmployeeDepartments::where('employee_department_id', $employeeDepartment->id)
                ->where('employee_id', $employee->id)->update([
                    'employee_id' => $employeeDepartment->manager->id,
                ]);
            EmployeeDependency::where('employee_department_id', $employeeDepartment->id)
                ->where('employee_id', $employee->id)
                ->update(['employee_id' => $employeeDepartment->manager->id]);
            $employee->dependency->update([
                'employee_id' => null,
                'management_id' => null,
                'employee_department_id' => null,
            ]);
        }
    }

    /**
     * Handle the EmployeeDepartment "deleted" event.
     *
     * @param EmployeeDepartment $employeeDepartment
     * @return void
     */
    public function deleted(EmployeeDepartment $employeeDepartment)
    {
        EmployeeDependency::where('department_id', $employeeDepartment->id)->update([
            'employee_id' => null,
            'employee_department_id' => null,
        ]);
        AllDepartment::where('employee_department_id', $employeeDepartment->id)->delete();
        EmployeesToEmployeeDepartments::where('employee_department_id', $employeeDepartment->id)
            ->delete();
        EmployeeToEmployeeDepartments::where('employee_department_id', $employeeDepartment->id)
            ->delete();
    }

    /**
     * Handle the EmployeeDepartment "restored" event.
     *
     * @param EmployeeDepartment $employeeDepartment
     * @return void
     */
    public function restored(EmployeeDepartment $employeeDepartment)
    {
        //
    }

    /**
     * Handle the EmployeeDepartment "force deleted" event.
     *
     * @param EmployeeDepartment $employeeDepartment
     * @return void
     */
    public function forceDeleted(EmployeeDepartment $employeeDepartment)
    {
        //
    }
}
