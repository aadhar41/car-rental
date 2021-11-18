<?php

namespace App\Traits;

use App\Models\Vehicle;
use App\Models\VehiclePricingDay;
use App\Models\VehiclePricingBucket;

trait VehiclePricingBucketTrait
{
    public function buckets()
    {
        return $this->hasMany('App\Models\VehiclePricingBucket', 'vehicle_id')->select('rate', 'vehicle_id', 'bucket_id');
    }

    // for weekdays
    public function bucket1()
    {
        return $this->hasOne('App\Models\VehiclePricingBucket', 'vehicle_id')->where('bucket_id', 1)->select('rate', 'vehicle_id', 'bucket_id')->with("bucketdetails");
    }

    // for weekend
    public function bucket2()
    {
        return $this->hasOne('App\Models\VehiclePricingBucket', 'vehicle_id')->where('bucket_id', 2)->select('rate', 'vehicle_id', 'bucket_id')->with("bucketdetails");
    }

    // for monthly
    public function bucket3()
    {
        return $this->hasOne('App\Models\VehiclePricingBucket', 'vehicle_id')->where('bucket_id', 3)->select('rate', 'vehicle_id', 'bucket_id')->with("bucketdetails");
    }

    // for chauffeured
    public function bucket4()
    {
        return $this->hasOne('App\Models\VehiclePricingBucket', 'vehicle_id')->where('bucket_id', 4)->select('rate', 'vehicle_id', 'bucket_id')->with("bucketdetails");
    }
}
