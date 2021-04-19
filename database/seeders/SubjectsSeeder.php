<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
                        ['name'=>'kiswahili', 'sw_name' =>'Kiswahili', 'short'=>'kisw'],
                        ['name'=>'English', 'sw_name' =>'Kiingereza', 'short'=>'eng'],
                        ['name'=>'mathematics', 'sw_name' =>'Hisabati', 'short'=>'math'],
                        ['name'=>'science', 'sw_name' =>'sayansi', 'short'=>'scie'],
                        ['name'=>'social studies', 'sw_name' =>'maarifa ya jamii', 'short'=>'soc'],
                        ['name'=>'civic and moral', 'sw_name' =>'uraia na maadili', 'short'=>'cam'],
                        ['name'=>'vocational studies', 'sw_name' =>'stadi za kazi', 'short'=>'voc'],
                        ['name'=>'reading', 'sw_name' =>'kusoma', 'short'=>'read'],
                        ['name'=>'writing', 'sw_name' =>'kuandika', 'short'=>'write'],
                    ];

        foreach ($subjects as $key => $subject) {
            Subject::create($subject);
        }
    }
}
