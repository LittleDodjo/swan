<?php

namespace Database\Seeders;

use App\Models\BaseModel\Employee\Appointment;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
use App\Models\OutgoingModel\OrganizationRegister;

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
    }
}
