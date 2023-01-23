<?php

namespace Database\Seeders;

use App\Models\OutgoingModel\OrganizationRegister;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrganizationRegister::create([
            'index' => 123456,
            'city' => 'Челябинск',
            'street' => 'Елькина',
            'number' => '63Б',
            'name' => 'Тестовая организация 1',
        ]);
    }
}
