<?php

use Illuminate\Database\Seeder;
use OSD\Semester;


class SemestersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $semesters = array(
            "2014-1","2014-2","2015-1","2015-2","2016-1","2016-2",
            "2017-1","2017-2","2018-1","2018-2","2013-1","2013-2"
        );
          
        for ($i = 0; $i<10; $i++) {

            $subject = Semester::create([
            'name' => $semesters[$i],
            ]);
        }
    }
}
