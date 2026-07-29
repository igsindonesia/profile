<?php

namespace Database\Factories;

use App\Models\PersonalInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PersonalInfo>
 */
class PersonalInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'academic_titles' => fake()->jobTitle(),
            'nidn' => fake()->numerify('##########'),
            'nip' => fake()->numerify('##################'),
            'birth_place' => fake()->city(),
            'birth_date' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'marital_status' => fake()->randomElement(['Single', 'Married']),
            'functional_position' => fake()->jobTitle(),
            'structural_position' => fake()->jobTitle(),
            'academic_position' => fake()->jobTitle(),
            'institution' => fake()->company(),
            'address_office' => fake()->address(),
            'address_home' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'produced_graduates_s1' => fake()->numberBetween(0, 100),
            'produced_graduates_s2' => fake()->numberBetween(0, 100),
            'produced_graduates_s3' => fake()->numberBetween(0, 100),
            'scopus_id' => fake()->bothify('##########'),
            'sinta_id' => fake()->bothify('##########'),
            'google_scholar_id' => fake()->bothify('????????????????'),
        ];
    }
}
