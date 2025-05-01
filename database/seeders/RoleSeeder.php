<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ["name"=> "admin", "slug"=> "admin",  "created_at"=> now(), "updated_at"=> now()],
            ["name"=> "user", "slug"=> "user",  "created_at"=> now(), "updated_at"=> now()],
            ["name"=> "viewer", "slug"=> "viewer",  "created_at"=> now(), "updated_at"=> now()],
        ];

        Role::truncate();
        Role::insert($roles);
    }
}
