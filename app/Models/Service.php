<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StatusTrait;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;

    protected $table = 'services';

    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
