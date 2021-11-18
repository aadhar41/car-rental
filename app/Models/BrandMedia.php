<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class BrandMedia extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'brand_media';

    protected $fillable = ['user_id', 'brand_id', 'created_at', 'updated_at'];
}
