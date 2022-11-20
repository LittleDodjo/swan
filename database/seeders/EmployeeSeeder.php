<?php

namespace Database\Seeders;

use App\Models\BaseModels\Employees\Employee;
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
        Employee::create([
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => "Олег",
            'last_name' => "Гуськов",
            'patronymic' => "Олегович",
            'phone_number' => "211-11-11",
            'email' => "soave99@bk.ru",
        ]);
    }
}
