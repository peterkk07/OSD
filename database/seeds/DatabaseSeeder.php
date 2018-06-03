<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        /*$this->call('OpcionSeeder');
        $this->call('preguntaSeeder');
        $this->call('RespuestaSeeder');*/
         $this->call('UserTypeSeeder');
    }
}



