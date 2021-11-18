<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => Str::random(10),
            'user_id' => User::pluck('id')->random(),
            // 'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'image' => "https://robohash.org/" . Str::random(5),
            'title' => $this->faker->jobTitle(),
            'education' => $this->faker->name(),
            'location' => $this->faker->address(),
            'skills' => $this->faker->address(),
            'note' => $this->faker->realText(),
            'status' => "1",
        ];
    }
}
