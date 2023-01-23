<?php

namespace Database\Seeders;

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
use App\Models\OutgoingModel\OrganizationRegister;
use App\Models\OutgoingModel\Stamps\StampBalance;
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
        $this->call(OrganizationSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(UserSeeder::class);
        Employee::factory(2)->create(['rank' => 3]);
        Employee::factory(2)->create(['rank' => 2]);
        Employee::factory(6)->create(['rank' => 1]);
        Employee::factory(2)->create(['rank' => 7]);
        Employee::factory(2)->create(['rank' => 6]);
        Management::factory(1)->create();
        $this->call(StampBalanceSeeder::class);
        $this->call(StampRegisterSeeder::class);
        $this->call(OrganizationRegisterSeeder::class);
    }
}
