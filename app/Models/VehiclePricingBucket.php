<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class VehiclePricingBucket extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'vehicle_pricing_buckets';

    protected $fillable = ['user_id', 'vehicle_id', 'created_at', 'updated_at'];

    public function bucketdetails()
    {
        return $this->belongsTo("App\Models\Bucket", 'bucket_id')->select("id", "name", "unique_id");
    }
}
