<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BrandMedia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BrandMedia::class;

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
            'brand_id' => $this->faker->name(),
            'user_id' => User::pluck('id')->random(),
            'file' => $file,
            // 'file' => "https://source.unsplash.com/1600x900/?car",
            // 'file' => $this->faker->imageUrl($width = 640, $height = 480),
            'type' => $n,
            'status' =>  "1",
        ];
    }
}
