<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            "type" => "admin",
            "name" => "super admin",
            "email" => "admin@gmail.com",
            "password" => \Illuminate\Support\Facades\Hash::make("admin@gmail.com"),
        ]);
        if ($user){
            echo "User created successfully!";
        }
    }
}
