<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AcademicDiscipline;
use App\Models\Homework;
use App\Models\LearningClass;
use App\Models\Point;
use App\Models\User;
use Database\Seeders\Users\CreateRoleAdmin;
use Database\Seeders\Users\CreateRoleGuest;
use Database\Seeders\Users\CreateRoleStudent;
use Database\Seeders\Users\CreateRoleTeacher;
use Database\Seeders\Users\CreateSuperAdmin;
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
        //дальше убрать 
        $this->call(CreateSuperAdmin::class);

        User::factory(10)->create();
        User::factory(20)->create()->each(function ($q) {
            $q->removeRole(ModelsRole::findByName('Guest'));
            $q->roles()->save(ModelsRole::findByName('Teacher'));
        });

        User::factory(60)->create()->each(function ($q) {
            $q->removeRole(ModelsRole::findByName('Guest'));
            $q->roles()->save(ModelsRole::findByName('Student'));
        });


        AcademicDiscipline::factory(60)->create()->each(function($q){
            $teachers = User::whereHas('roles', function ($query) {
                $query->where('name', 'teacher');
            })->inRandomOrder()->get();

            for($i=0; $i<=rand(0,5); $i++)
                $q->users()->save($teachers[$i]);
        });


        LearningClass::factory(20)->create()->each(function($q){
            
            $disciplines = AcademicDiscipline::inRandomOrder()->get();
            for($i=0; $i<=rand(0,10); $i++)
                $q->academicDisciplines()->save($disciplines[$i]);
            
            $q->users()->save(User::whereHas('roles', function ($query) {
                $query->where('name', 'teacher');
            })->inRandomOrder()->first());

            $students = User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->inRandomOrder()->get();

            for ($i = 0; $i <= rand(0, 10); $i++)
            $q->users()->save($students[$i]);

        });
       

        Point::factory(100)->create();

        Homework::factory(100)->create();


    }
}
