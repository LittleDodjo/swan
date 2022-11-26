<?php

namespace Database\Seeders;

use App\Models\BaseModels\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
            'name' => "Министерство социальных отношений",
            'short_name' => "Минсоцотношений"
        ]);
    }
}
