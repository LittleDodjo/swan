<?php


namespace App\Http\Controllers\Api\BaseProvider;


use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managements\Management;
use App\Models\BaseModels\Pivots\DepartmentsToManagement;
use App\Models\BaseModels\Pivots\EmployeeDepartamentsToEmployee;
use App\Models\BaseModels\Pivots\EmployeesToDepartment;
use App\Models\BaseModels\Pivots\EmployeesToEmployeeDepartment;

/**
 * Класс для проверки завимостей сотрудников, управлений и отделов
 * @package App\Http\Controllers\Api\BaseProvider
 */
class DependencyProvider
{

    /**
     * Конфигруация зависимостей по рангам сотрудников
     * @var array
     */
    protected static array $employeeConfig = [
        7 => [0],
        6 => [7],
        5 => [7],
        4 => [5, 6],
        3 => [4, 5, 6, 7],
        2 => [3],
        1 => [2, 3],
    ];

    /**
     * Конфигурация зависимостей отделов
     * @var array|int[]
     */
    protected static array $departmentConfig = [1, 2, 3];

    /**
     * Конфигруация зависимостей управлений
     * @var array|int[][]
     */
    protected static array $managementConfig = [
        'isDepends' => [5, 6],
        'isPrimary' => [4]
    ];

    /**
     * Проверяет раг двух сотрудников в соответствии с правилами
     * @param int $employeeDependsRank зависимый сотрудник
     * @param int $employeePrimaryRank ведомый сотрудник
     * @return bool
     */
    public static function checkEmployeeDependency(int $employeeDependsRank, int $employeePrimaryRank): bool
    {
        return in_array($employeePrimaryRank, self::$employeeConfig[$employeeDependsRank]);
    }

    /**
     * Проверяет возможность устрановить зависимость управления к сотруднику
     * @param int|null $rank Ранг сотрудника
     */
    public static function checkManagementDependency(?int $rank = null): bool
    {
        return in_array($rank, self::$managementConfig['isDepends']);
    }

    /**
     * Проверяет возможность установки зависимости управления к руководителю
     * @param int|null $rank ранг сотрудника
     * @return bool
     */
    public static function checkManagementManager(?int $rank = null): bool
    {
        return in_array($rank, self::$managementConfig['isPrimary']);
    }

    /**
     * Можно ли добавить сотрудника такого ранга в отдел
     * @param int $rank ранг сотрудника
     * @return bool
     */
    public static function checkDepartmentEmployee(int $rank): bool
    {
        return in_array($rank, self::$departmentConfig);
    }
}
