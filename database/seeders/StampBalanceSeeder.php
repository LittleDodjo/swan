<?php

namespace Database\Seeders;

use App\Models\OutgoingModel\Stamps\StampBalance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StampBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StampBalance::create([
            'employee_id' => 1,
            'type' => true,
            'balance' => array()
        ]);
    }
}
