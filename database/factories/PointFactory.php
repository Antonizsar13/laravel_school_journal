<?php

namespace Database\Factories;

use App\Models\AcademicDiscipline;
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
        return [
            'point' => fake()->biasedNumberBetween(0,5),
            'user_id' => User::inRandomOrder()->first()->id,
            'academic_discipline_id' => AcademicDiscipline::inRandomOrder()->first()->id,
        ];
    }
}
