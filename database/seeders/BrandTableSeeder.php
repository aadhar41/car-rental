<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Brand;
use App\Models\BrandMedia;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('brands')->truncate();
        DB::table('brand_media')->truncate();


        \App\Models\User::factory(10)->create()
            ->each(function ($u) {
                $u->brands()
                    ->saveMany(
                        \App\Models\Brand::factory(1)->make()
                    )
                    ->each(function ($q) {
                        $q->media()->saveMany(
                            \App\Models\BrandMedia::factory(2)->make()
                        );
                    });
            });
    }
}
