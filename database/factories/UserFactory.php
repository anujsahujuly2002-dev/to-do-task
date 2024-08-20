<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>"Mr.",
            'name'=>$this->faker->name(),
            'last_name'=>$this->faker->name(),
            'date_of_birth'=>"1998-08-11",
            "profile_picture"=>"dhjsdhjsdjsdjsdhjsdhjsd",
            "mobile_no"=>"9305238392",
            "department_id"=>"1",
            "designation_id"=>"1",
            "email"=>$this->faker->unique()->safeEmail(),
            "password"=>Hash::make('Admin@123#'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
