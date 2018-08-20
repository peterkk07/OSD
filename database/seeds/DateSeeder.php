<?php

use Illuminate\Database\Seeder;
use OSD\Dates;


class DateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Dates::class, 200)->create();

    }
}
