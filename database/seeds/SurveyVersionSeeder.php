<?php

use Illuminate\Database\Seeder;
use OSD\UpdateSurveyCount;

class SurveyVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $count = UpdateSurveyCount::create([
            'count' => 1,
            
        ]);
        
    }
}

