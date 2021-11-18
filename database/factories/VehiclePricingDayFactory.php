<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\VehicleStat;
use App\Models\VehiclePricingDay;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiclePricingDayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehiclePricingDay::class;

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
            'days' => rand(1, 10),
            'rate' => rand(2000, 5000),
            'status' => "1",
        ];
    }
}
