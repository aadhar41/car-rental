<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class VehicleFeature extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'vehicle_features';

    protected $fillable = ['user_id', 'brand_id', 'vehicle_id', 'created_at', 'updated_at'];

    public function branddetails()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function vehicledetails()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id');
    }

    public function userdetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
