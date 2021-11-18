<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

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
            // 'image' => "https://robohash.org/" . Str::random(5),
            'image' => "https://source.unsplash.com/1600x900/?car",
            'status' => "1",
        ];
    }
}
