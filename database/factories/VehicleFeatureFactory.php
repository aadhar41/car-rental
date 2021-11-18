<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\VehicleFeature;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleFeature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $colours = array("black", "white", "red");
        $coloursCodes = array("#000000", "#ffffff", "#ff0000");
        return [
            'unique_id' => Str::random(10),
            'user_id' => User::pluck('id')->random(),
            'brand_id' => Brand::pluck('id')->random(),
            'vehicle_id' => Vehicle::pluck('id')->random(),
            // 'colour' => $colours[rand("0", "2")],
            'colour' => $this->faker->colorName(),
            // 'colour_code' => $coloursCodes[rand("0", "2")], hexcolor
            'colour_code' => $this->faker->hexcolor(),
            'persons' => rand(2, 6),
            'gear_box' => rand(2, 6) .  " " . Str::random(5),
            'status' => "1",
        ];
    }
}
