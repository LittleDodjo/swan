<?php

namespace Database\Seeders;

use App\Models\BaseModels\Managements\Management;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Management::create(
            [
                'employee_manager_id' => 4,
                'employee_depends_id' => 3,
                'caption' => fake()->name(),
            ]
        );
    }
}
