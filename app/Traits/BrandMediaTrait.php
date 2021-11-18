<?php

namespace App\Traits;

use App\Models\Brand;
use App\Models\BrandMedia;

trait BrandMediaTrait
{
    public function media()
    {
        return $this->hasMany('App\Models\BrandMedia', 'brand_id')->where('status', '1');
    }

    public function images()
    {
        return $this->hasMany('App\Models\BrandMedia', 'brand_id')->where('type', '1');
    }

    // One logo
    public function logoFile()
    {
        return $this->hasOne('App\Models\BrandMedia', 'brand_id')->where('type', '2')->where("status", "1");
    }

    // One favicon
    public function faviconFile()
    {
        return $this->hasOne('App\Models\BrandMedia', 'brand_id')->where('type', '3');
    }

    // One banner
    public function bannerFile()
    {
        return $this->hasOne('App\Models\BrandMedia', 'brand_id')->where('type', '4');
    }

    public function document()
    {
        return $this->hasMany('App\Models\BrandMedia', 'brand_id')->where('type', '5');
    }

    // One main Image
    public function mainImage()
    {
        return $this->hasOne('App\Models\BrandMedia', 'brand_id')->where('type', '6')->where("status", "1");
    }
}
