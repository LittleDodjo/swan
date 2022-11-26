<?php

namespace Database\Seeders;

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
//        $this->call(AppointmentSeeder::class);
//        $this->call(EmployeeSeeder::class);
//        $this->call(UserSeeder::class);
        Management::factory(10)->create();
    }
}
