<?php


namespace App\Http\Controllers\Api\BaseHelper;


use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managements\Management;
use App\Models\BaseModels\Pivots\DepartmentsToManagement;
use App\Models\BaseModels\Pivots\EmployeeDepartamentsToEmployee;
use App\Models\BaseModels\Pivots\EmployeesToDepartment;
use App\Models\BaseModels\Pivots\EmployeesToEmployeeDepartment;

class DependencyHelper
{


    /**
     * Конфигурация типов отделов и моделей зависимостей
     * @var array|string[][]
     */
    protected static array $departmentsConfig = [
        'mdep' => [
            'model' => Department::class,
            'depends_model' => Management::class,
            'depends_key' => 'management_depends',
            'pivot_model' => DepartmentsToManagement::class,
            'pivot_key' => 'management_id',
            'department_key' => 'department_id',
            'employees_model' => EmployeesToDepartment::class,
            'employees_key' => 'department_id',
        ],
        'edep' => [
            'model' => EmployeeDepartment::class,
            'depends_model' => Employee::class,
            'depends_key' => 'employee_depends',
            'pivot_model' => EmployeeDepartamentsToEmployee::class,
            'pivot_key' => 'employee_id',
            'department_key' => 'employee_department_id',
            'employees_model' => EmployeesToEmployeeDepartment::class,
            'employees_key' => 'employee_department_id',
        ],
    ];

    /**
     * Метод выполняется если был изменен руководитель управления,
     * В таком случае, все руководители отделений этого управления должны получить нового
     * сотрудника в качестве ведомого
     * @param Management $management управление, которое требуется обновить
     * @param int $id идентификатор нового руководителя
     */
    public static function updateManagementDependency(Management $management, int $id)
    {
        $primaryManagersDepartments = $management->departments == null;
        if ($primaryManagersDepartments != null) {
            foreach ($primaryManagersDepartments as $key => $v) {
                $key->update(
                    ['...']
                );
            }
        }
    }

    public static function updateDepartmentDependency()
    {

    }

    public static function updateEmployeeDependency()
    {

    }


}
