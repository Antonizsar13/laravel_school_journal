<?php

namespace Database\Factories;

use App\Models\AcademicDiscipline;
use App\Models\LearningClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Point>
 */
class PointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->whereHas('learningClasses')->inRandomOrder()->first();
        
        return [
            'point' => fake()->biasedNumberBetween(0,5),
            'user_id' => $user->id,
            'academic_discipline_id' => $user->learningClasses[0]->academicDisciplines()->inRandomOrder()->first()->id,
        ];
    }
}
