<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
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
        $user = new User(['login' => 'soave99']);
        $user->password = Hash::make('123456');
        $user->save();
        UserRole::create([
            'user_id' => $user->id,
            'is_root' => true,
            'is_admin' => true,
            'is_control' => true,
        ]);
    }
}
