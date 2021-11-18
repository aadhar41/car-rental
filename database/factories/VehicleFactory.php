<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company() . " " . $this->faker->buildingNumber();
        return [
            'unique_id' => Str::random(10),
            'user_id' => User::pluck('id')->random(),
            'brand_id' => Brand::pluck('id')->random(),
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'slogan' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'status' => "1",
        ];
    }
}
