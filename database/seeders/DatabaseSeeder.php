<?php

namespace Database\Seeders;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppointmentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(OrganizationSeeder::class);
        Employee::factory(4)->create(['rank' => 1]);
        Department::factory(4)->create();
    }
}
