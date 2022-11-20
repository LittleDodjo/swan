<?php

namespace Database\Seeders;

use App\Models\BaseModels\Employees\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::create([
            'caption' => 'Ведущий специалист-эксперт',
            'is_manager' => false,
            'is_primary_manager' => false,
        ]);
    }
}
