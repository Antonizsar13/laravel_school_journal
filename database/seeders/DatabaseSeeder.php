<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AcademicDiscipline;
use App\Models\LearningClass;
use App\Models\Point;
use App\Models\User;
use Database\Seeders\Users\CreateRoleAdmin;
use Database\Seeders\Users\CreateRoleGuest;
use Database\Seeders\Users\CreateRoleStudent;
use Database\Seeders\Users\CreateRoleTeacher;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CreateRoleGuest::class);
        $this->call(CreateRoleStudent::class);
        $this->call(CreateRoleTeacher::class);
        $this->call(CreateRoleAdmin::class);
        
        AcademicDiscipline::factory(20)->create();
        LearningClass::factory(20)->create()->each(function($q){
            for($i=0; $i<=rand(0,3); $i++)
            $q->academicDisciplines()->save(AcademicDiscipline::inRandomOrder()->first());
        });

        User::factory(10)->create();
        User::factory(20)->create()->each(function ($q) {
            $q->removeRole(ModelsRole::findByName('Guest'));
            $q->roles()->save(ModelsRole::findByName('Teacher'));
            $q->academicDisciplines()->save(AcademicDiscipline::inRandomOrder()->first());
        });
        User::factory(40)->create()->each(function ($q) {
            $q->removeRole(ModelsRole::findByName('Guest'));
            $q->roles()->save(ModelsRole::findByName('Student'));
            $q->learningClasses()->save(LearningClass::inRandomOrder()->first());
        });

        Point::factory(100)->create();


    }
}
