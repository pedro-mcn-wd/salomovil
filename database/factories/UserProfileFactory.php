<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\UserProfile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $number = rand(10000000, 99999999);
        $letter = substr("TRWAGMYFPDXBNJZSQVHLCKE", $number%23, 1);

        return [
            'user_id' => User::inRandomOrder()->distinct()->pluck('id')->first(),
            'name' => fake()->firstName,
            'surname_first' => fake()->lastName,
            'surname_second' => fake()->lastName,
            'dni' => $number.$letter,
            'bio' => fake()->paragraph,
            'birthdate' => fake()->dateTimeBetween('-50 years', '-18 years'),
        ];
    }
}
