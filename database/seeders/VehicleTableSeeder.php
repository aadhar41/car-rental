<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Vehicle;
use App\Models\VehicleMedia;
use App\Models\VehicleStat;
use App\Models\VehiclePricingDay;
use Illuminate\Support\Facades\DB;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('users')->truncate();
        DB::table('user_profiles')->truncate();
        DB::table('brands')->truncate();
        DB::table('brand_media')->truncate();
        DB::table('vehicles')->truncate();
        DB::table('vehicle_features')->truncate();
        DB::table('vehicle_media')->truncate();
        DB::table('vehicle_pricing_days')->truncate();
        DB::table('vehicle_stats')->truncate();
        DB::statement("SET foreign_key_checks=1");

        \App\Models\User::factory(10)->create()
            ->each(function ($u) {
                $u->profile()->saveMany(
                    \App\Models\UserProfile::factory(1)->make()
                );
                $u->brands()
                    ->saveMany(
                        \App\Models\Brand::factory(1)->make()
                    )
                    ->each(function ($q) {
                        $q->media()->saveMany(
                            \App\Models\BrandMedia::factory(2)->make()
                        );
                    });
                $u->brands()->each(function ($v) {
                    $v->associatedVehicles()->saveMany(
                        \App\Models\Vehicle::factory(3)->make(),
                    )
                        ->each(function ($s) {
                            $s->media()->saveMany(
                                \App\Models\VehicleMedia::factory(2)->make(),
                            );
                            $s->stats()->saveMany(
                                \App\Models\VehicleStat::factory(1)->make(),
                            );
                            $s->features()->saveMany(
                                \App\Models\VehicleFeature::factory(1)->make(),
                            );
                            $s->package()->saveMany(
                                \App\Models\VehiclePricingDay::factory(6)->make(),
                            );
                        });
                });
            });
    }
}
