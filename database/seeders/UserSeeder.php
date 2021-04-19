<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = [
            [
                'first_name' => 'raphael', 'second_name' => 'm', 'sur_name' => 'Sinkonde', 'email' => 'raphaelsinkonde1991@gmail.com', 'password'=> Hash::make('Amasenda')
            ]
        ];
        foreach ($users as $u => $user) {
            User::create($user);
        }
    }
}
