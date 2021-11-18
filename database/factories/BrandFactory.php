<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => Str::random(10),
            'name' => $this->faker->company(),
            'user_id' => User::pluck('id')->random(),
            'slug' => Str::slug($this->faker->name(), '-'),
            'heading' => $this->faker->sentence(),
            'slogan' => $this->faker->text(),
            'status' => "1",
        ];
    }
}
