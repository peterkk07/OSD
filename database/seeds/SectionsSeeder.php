<?php

use Illuminate\Database\Seeder;
use OSD\Section;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sections = array(
            "C1","C2","C3","E1","E2","E3",
            "M1","M2","M3","F1","F2","F3"
        );

        $count = count( $sections);

        for ($i = 0; $i<$count; $i++) {

            $subject = Section::create([
            'name' => $sections[$i],
            ]);
        }
    }
}
