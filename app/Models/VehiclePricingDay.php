<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class VehiclePricingDay extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'vehicle_pricing_days';

    protected $fillable = ['user_id', 'brand_id', 'vehicle_id', 'created_at', 'updated_at'];
}
