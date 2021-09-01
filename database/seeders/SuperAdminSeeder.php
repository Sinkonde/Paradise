<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Traits\UserControllerTrait;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    //use UserControllerTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'raphaelsinkonde1991@gmail.com')->first();
        if($user){
            $user->assignRole('Super Admin');
        }
    }
}
