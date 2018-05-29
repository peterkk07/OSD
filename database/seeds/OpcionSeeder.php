<?php

use Illuminate\Database\Seeder;

class OpcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OSD\Opcion::class, 5)->create();
    }
}
