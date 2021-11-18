<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class Bucket extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'buckets';

    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function attachedbuckets()
    {
        return $this->hasMany('App\Models\VehiclePricingBucket', 'bucket_id');
    }
}
