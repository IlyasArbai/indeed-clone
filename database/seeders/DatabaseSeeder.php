<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('companies')->truncate();
        DB::table('job_listings')->truncate();

        Account::create([
            'email' => '1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'ilyas',
            'last_name' => 'arbai',
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
            'account_id' => 1,
        ]);

        User::factory(10)->create();
        Company::factory(10)->create();
        Job::factory(100)->create();
    }
}
