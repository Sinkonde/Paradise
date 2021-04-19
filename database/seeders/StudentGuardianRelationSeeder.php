<?php

namespace Database\Seeders;

use App\Models\StudentGuardianRelation;
use Illuminate\Database\Seeder;

class StudentGuardianRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relations = [
            ['name' => 'Baba Mzazi', 'gender' => 'm'],
            ['name' => 'Mama Mzazi', 'gender' => 'f'],
            ['name' => 'Baba Mlezi', 'gender' => 'm'],
            ['name' => 'Mama Mlezi', 'gender' => 'f'],
            ['name' => 'Kaka', 'gender' => 'm'],
            ['name' => 'Dada', 'gender' => 'f'],
            ['name' => 'Mjomba', 'gender' => 'm'],
            ['name' => 'Shangazi', 'gender' => 'f'],
            ['name' => 'Babu', 'gender' => 'm'],
            ['name' => 'Bibi', 'gender' => 'f'],
        ];

        foreach ($relations as $key => $relation) {
            StudentGuardianRelation::create($relation);
        }
    }
}
