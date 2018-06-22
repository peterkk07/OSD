<?php

use Illuminate\Database\Seeder;
use OSD\Coordinator;
use OSD\KnowledgeArea;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(OSD\Coordinator::class, 10)->create();

    }
}
