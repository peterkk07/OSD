<?php

use Illuminate\Database\Seeder;
use OSD\User;
use OSD\UserType;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$user = User::create([

            'name' => "admin",
            'ci' => "123456",
            'email' => "admin.osd@gmail.com",
            'password' => bcrypt("admin"),
        ]);
    
        $userType= UserType::where("description","Administrador")->first()->id;
        $user->type_user()->associate($userType);
        $user->save();


    }
}





  
        

