<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $account = Account::create([
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
            'remember_token' => Str::random(10),
        ]);

        return [
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->phoneNumber(),
            'resume' => 'resumes/fake_resume.pdf',
            'bio' => fake()->paragraph(2),
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
            'account_id' => $account->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
