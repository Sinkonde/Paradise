<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'owner','teacher', 'accountant', 'parent', 'head-teacher', 'manager', 'academic', 'Super Admin'];
        foreach ($roles as $r => $role) {
            Role::create(['name'=>$role]);
        }
    }
}
