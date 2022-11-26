<?php

namespace Database\Seeders;

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDependency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'first_name' => "Руководитель",
            'last_name' => "Управления",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'rank' => 4,
            'email' => "soave99@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Зам",
            'last_name' => "Министра",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'rank' => 5,
            'email' => "soave991@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);

        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Руководитель",
            'last_name' => "Управления",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'rank' => 4,
            'email' => "soave9339@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Зам",
            'last_name' => "Министра",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'rank' => 5,
            'email' => "soave99111@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Руководитель",
            'last_name' => "Управления",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'rank' => 4,
            'email' => "soave99ff@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Зам",
            'last_name' => "Министра",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'rank' => 5,
            'email' => "soave9fa91@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Рядовой такой-то",
            'last_name' => "Управления",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'rank' => 1,
            'email' => "soave929@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
        $depency = EmployeeDependency::create();
        $employee = Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Зам",
            'last_name' => "Рядовой еще один",
            'patronymic' => "Такого-то",
            'phone_number' => "211-11-11",
            'cabinet' => '42',
            'user_id' => 1,
            'rank' => 1,
            'email' => "soave994@bk.ru",
            'employee_dependency_id' => $depency->id,
        ]);
    }
}