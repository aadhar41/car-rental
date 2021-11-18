<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleMedia;
use App\Models\VehicleStat;
use App\Models\VehicleFeature;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\BrandMedia;
use App\Traits\VehiclePricingTrait;
use App\Traits\VehicleMediaTrait;
use App\Traits\VehiclePricingBucketTrait;
use App\Traits\StatusTrait;

class Vehicle extends Model
{
    use HasFactory;
    // Relation belongs to vehicle pricing are in this trait.
    use VehiclePricingTrait;
    // Relation belongs to vehicle media are in this trait.
    use VehicleMediaTrait;
    // Relation belongs to vehicle pricing bucket are in this trait.
    use VehiclePricingBucketTrait;
    use StatusTrait;

    protected $table = 'vehicles';

    protected $fillable = ['user_id', 'brand_id', 'created_at', 'updated_at'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Set the vehicle's slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value, '-');
        $this->attributes['slug'] = strtolower($slug);
    }

    public function vehicleLogoUrl()
    {
        return url('/images/vehicles/logos/') . "/";
    }

    public function vehicleImageUrl()
    {
        return url('/images/vehicles/images/') . "/";
    }

    public function brandLogoUrl()
    {
        return url('/images/brands/logos/') . "/";
    }

    public function brandImageUrl()
    {
        return url('/images/brands/images/') . "/";
    }

    // Vehicle Stats
    public function stats()
    {
        return $this->hasOne('App\Models\VehicleStat', 'vehicle_id')->where('status', '1')->select('engine', 'power', 'zero_to_hundred', 'top_speed', 'weight', 'vehicle_id');
    }

    // Vehicle Features
    public function features()
    {
        return $this->hasOne('App\Models\VehicleFeature', 'vehicle_id')->where('status', '1')->select('colour', 'colour_code', 'persons', 'gear_box', 'vehicle_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
}
