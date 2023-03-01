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
        $appointments = [
            'Министр',
            'Первый заместитель Министра',
            'Начальник управления',
            'Начальник',
            'Заместитель начальника',
            'Консультант',
            'Главный специалист',
            'Ведущий специалист',
            'Старший экономист',
            'Старший инспектор',
            'Заместитель Министра',
            'Начальник отдела',
            'Заместитель начальника отдела',
            'Ведущий экономист',
            'Начальник службы',
            'Ведущий специалист-эксперт',
            'Начальник мобилизационной службы',
        ];
        foreach ($appointments as $key => $value){
            Appointment::create([
                'caption' => $value,
            ]);
        }

    }
}
