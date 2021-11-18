<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Models\Vehicle;
use App\Models\VehicleMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nums = array(2, 6);
        $n = $nums[rand("0", "1")];
        $logos = array(
            "https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png",
            "https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo2.png",
            "https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo3.png",
            "https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo4.png",
        );

        if ($n == 2) {
            $file = $logos[$n];
        } else {
            $file = "https://lorempixel.com/640/480/transport/";
        }

        return [
            'unique_id' => Str::random(10),
            'user_id' => User::pluck('id')->random(),
            'vehicle_id' => Vehicle::pluck('id')->random(),
            'file' => $file,
            // 'file' => $this->faker->imageUrl($width = 640, $height = 480),
            // 'file' => "https://source.unsplash.com/1600x900/?car",
            'type' => $n,
            'status' => "1",
        ];
    }
}
