<?php

namespace Database\Seeders;

use App\Models\BaseModel\Employee\Appointment;
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
        ]);
    }
}
