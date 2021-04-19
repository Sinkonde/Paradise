<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            [
                "first_name"=>'anna', "second_name"=>'john', 'sur_name'=>"joseph", 'gender' =>'f'
            ],
            [
                "first_name"=>'skola', "second_name"=>'jackson', 'sur_name'=>"mane", 'gender' =>'f'
            ],
            [
                "first_name"=>'allen', "second_name"=>'ackson', 'sur_name'=>"masibo", 'gender' =>'m'
            ],
            [
                "first_name"=>'mwamsojo', "second_name"=>'kane', 'sur_name'=>"bimbi", 'gender' =>'m'
            ],
            [
                "first_name"=>'rachel', "second_name"=>'sagguda', 'sur_name'=>"bizare", 'gender' =>'f'
            ],
        ];

        foreach ($students as $s => $student) {
            //Student::create(['user_id' => User::create($student)->id]);
        }
    }
}
