<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\VehicleStat;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleStatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleStat::class;

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
            'brand_id' => Brand::pluck('id')->random(),
            'vehicle_id' => Vehicle::pluck('id')->random(),
            'engine' => Str::random(6),
            'power' => rand(200, 500),
            'zero_to_hundred' => rand(1, 9),
            'top_speed' => rand(200, 350),
            'weight' => rand(1200, 1800),
            'status' => "1",
        ];
    }
}
