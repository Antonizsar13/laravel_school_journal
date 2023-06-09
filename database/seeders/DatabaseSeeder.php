<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Users\CreateRoleGuest::class);
        $this->call(Users\CreateRoleStudent::class);
        $this->call(Users\CreateRoleTeacher::class);
        $this->call(Users\CreateRoleAdmin::class);

        \App\Models\User::factory(20)->create();
    }
}
