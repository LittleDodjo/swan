<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'login' => 'soave99',
            'password' => Hash::make('123456'),
            'is_confirmed' => true,
        ]);
        UserRoles::create([
            'user_id' => $user->id,
            'is_admin' => true,
            'is_root' => true,
            'is_control_manager' => true,
        ]);

    }
}
