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
          
        for ($i = 0; $i<10; $i++) {

            $subject = Semester::create([
            'name' => $i,
            ]);
        }
    }
}
