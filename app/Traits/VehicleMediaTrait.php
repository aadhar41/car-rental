<?php

namespace App\Traits;

use App\Models\Vehicle;
use App\Models\VehicleMedia;

trait VehicleMediaTrait
{
    public function media()
    {
        return $this->hasMany('App\Models\VehicleMedia', 'vehicle_id')->where('status', '1')->select('file', 'vehicle_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\VehicleMedia', 'vehicle_id')->where('type', '1')->select('file', 'vehicle_id');
    }

    // One logo
    public function logoFile()
    {
        return $this->hasOne('App\Models\VehicleMedia', 'vehicle_id')->where('type', '2')->select('file', 'vehicle_id');
    }

    // One favicon
    public function faviconFile()
    {
        return $this->hasOne('App\Models\VehicleMedia', 'vehicle_id')->where('type', '3')->select('file', 'vehicle_id');
    }

    // One banner
    public function bannerFile()
    {
        return $this->hasOne('App\Models\VehicleMedia', 'vehicle_id')->where('type', '4')->select('file', 'vehicle_id');
    }

    public function document()
    {
        return $this->hasMany('App\Models\VehicleMedia', 'vehicle_id')->where('type', '5')->select('file', 'vehicle_id');
    }

    // One main Image
    public function mainImage()
    {
        return $this->hasOne('App\Models\VehicleMedia', 'vehicle_id')->where('type', '6')->select('file', 'vehicle_id');
    }
}
