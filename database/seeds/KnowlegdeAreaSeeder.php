<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KnowlegdeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
			for ($i=0; $i < 5; $i++) {
			    \DB::table('knowledge_areas')->insert(array(
			           'name' => $faker->randomElement(['Diseño','Cálculo','Geometría','Análisis'])
			    ));
			}
    }
}
