<?php

namespace App\Models;

use App\Models\BrandMedia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\BrandMediaTrait;
use App\Traits\StatusTrait;

class Brand extends Model
{
    use HasFactory;
    use StatusTrait;

    // Relation belongs to brand media are in this trait.
    use BrandMediaTrait;

    protected $table = 'brands';

    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function brandLogoUrl()
    {
        return url('/images/brands/logos/') . "/";
    }

    public function brandImageUrl()
    {
        return url('/images/brands/images/') . "/";
    }

    public function iconicdreamsUrl()
    {
        return url('/images/iconicdreams/') . "/";
    }

    public function abouturl()
    {
        return url('/images/about/') . "/";
    }

    public function associatedVehicles()
    {
        return $this->hasMany('App\Models\Vehicle', 'brand_id')->where('status', '1');
    }
}
