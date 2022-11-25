<?php

namespace Database\Seeders;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Employees\EmployeeDependency;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Олег",
            'last_name' => "Гуськов",
            'patronymic' => "Олегович",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'user_id' => 1,
            'rank' => 3,
            'email' => "soave99@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
        $employee->employeeDependency()->associate($depency);
        $depency = EmployeeDependency::create();
        Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Щека",
            'last_name' => "Сергей",
            'patronymic' => "Владимирович",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'email' => "shekasv@bk.ru",
            'rank' => 2,
            'employee_dependency_id' => $depency->id,
        ]);
        $employee->employeeDependency()->associate($depency);
        $depency = EmployeeDependency::create();
        Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Заместитель",
            'last_name' => "Министра",
            'patronymic' => "Владимирович",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'email' => "zam@bk.ru",
            'rank' => 5,
            'employee_dependency_id' => $depency->id,
        ]);
        $employee->employeeDependency()->associate($depency);
        $depency = EmployeeDependency::create();
        Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Щека",
            'last_name' => "Начальник",
            'patronymic' => "Управления",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'email' => "naxh@bk.ru",
            'rank' => 4,
            'employee_dependency_id' => $depency->id,
        ]);
        $employee->employeeDependency()->associate($depency);
    }
}
