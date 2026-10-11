<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyId = Company::inRandomOrder()->value('id');

        return [
            'company_id' => $companyId,
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(2),
            'city' => fake()->randomElement([
                'Tangier',
                'Casablanca',
                'Rabat',
                'Bangkok',
                'Pattaya',
                'Paris',
                'Madrid',
                'Berlin',
            ]),
            'job_type' => fake()->randomElement(['Full-time', 'Part-time', 'Remote', 'Internship', 'Temporary']),
            'positions_available' => fake()->numberBetween(1, 10),
            'salary_min' => fake()->numberBetween(100, 500),
            'salary_max' => fake()->numberBetween(500, 1000),
            'requirements' => fake()->sentence(3),
            'expires_at' => fake()->dateTimeBetween('+1 day', '+1 week'),
        ];
    }
}
