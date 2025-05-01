<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ["name" => "Utkarsh","email"=> "utkarsh@gmail.com"],
            ["name"=> "Himanshu","email"=> "himanshu@gmail.com"],
            ["name"=> "Rahul","email"=> "rahul@gmail.com"],
        ];

        User::truncate();

        foreach ($users as $user) {
            User::create([
                "name"=> $user["name"],
                "email"=> $user["email"],
                "password"=> bcrypt("password"),
                "created_at"=> now(),
                "updated_at"=> now(),
            ]);
        }
    }
}
