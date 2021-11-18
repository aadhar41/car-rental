<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Membership::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => Str::random(10),
            'name' => $this->faker->name(),
            'user_id' => rand(1, 10),
            'days' => rand(1, 10),
            'rate' => rand(1000, 8000),
            'status' => "1",
        ];
    }
}
