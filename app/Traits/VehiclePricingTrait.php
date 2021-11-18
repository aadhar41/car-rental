<?php

namespace App\Traits;

use App\Models\Vehicle;
use App\Models\VehiclePricingDay;

trait VehiclePricingTrait
{
    public function package()
    {
        return $this->hasMany('App\Models\VehiclePricingDay', 'vehicle_id');
    }

    // for 1-2 days
    public function package1()
    {
        return $this->hasOne('App\Models\VehiclePricingDay', 'vehicle_id')->whereIn('days', [1, 2])->select('days', 'rate', 'vehicle_id');
    }

    // for 3-4 days
    public function package2()
    {
        return $this->hasOne('App\Models\VehiclePricingDay', 'vehicle_id')->whereIn('days', [3, 4])->select('days', 'rate', 'vehicle_id');
    }

    // for 5+ days
    public function package3()
    {
        return $this->hasOne('App\Models\VehiclePricingDay', 'vehicle_id')->where('days', '>=', 5)->select('days', 'rate', 'vehicle_id');
    }

    // for 1-2 days
    public function package1All()
    {
        return $this->hasMany('App\Models\VehiclePricingDay', 'vehicle_id')->whereIn('days', [1, 2])->select('days', 'rate', 'vehicle_id');
    }

    // for 3-4 days
    public function package2All()
    {
        return $this->hasMany('App\Models\VehiclePricingDay', 'vehicle_id')->whereIn('days', [3, 4])->select('days', 'rate', 'vehicle_id');
    }

    // for 5+ days
    public function package3All()
    {
        return $this->hasMany('App\Models\VehiclePricingDay', 'vehicle_id')->where('days', '>=', 5)->select('days', 'rate', 'vehicle_id');
    }
}
