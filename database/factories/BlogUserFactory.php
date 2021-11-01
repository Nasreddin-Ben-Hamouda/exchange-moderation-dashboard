<?php

namespace Database\Factories;

use App\Models\BlogUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "firstname"=>$this->faker->firstName,
            "lastname"=>  $this->faker->lastName,
            "email"=>$this->faker->unique()->safeEmail(),
            "birthdate" => $this->faker->date(),
            "created_at" => now()
        ];
    }
}
