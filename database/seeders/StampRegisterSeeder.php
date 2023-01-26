<?php

namespace Database\Seeders;

use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StampRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StampRegister::create([
            'value' => 1.5
        ]);
        StampRegister::create([
            'value' => 3
        ]);
        StampRegister::create([
            'value' => 1
        ]);
        StampRegister::create([
            'value' => 10
        ]);

    }
}
