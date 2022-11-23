<?php

namespace Database\Seeders;

use App\Models\BaseModels\Employees\Reason;
use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reason::create([
            'caption' => "Командировка",
            'is_always' => false,
        ]);
        Reason::create([
            'caption' => "Больничный лист",
            'is_always' => false,
        ]);
        Reason::create([
            'caption' => "Отпуск",
            'is_always' => false,
        ]);
        Reason::create([
            'caption' => "Увольнение",
            'is_always' => true,
        ]);
    }
}
