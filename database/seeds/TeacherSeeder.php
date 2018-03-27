<?php

use Illuminate\Database\Seeder;
use OSD\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(OSD\Teacher::class, 10)->create();
    }
}
