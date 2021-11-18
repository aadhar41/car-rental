<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class UserProfile extends Model
{
    use HasFactory;
    use StatusTrait;


    protected $table = 'user_profiles';

    /**
     * Get the user that owns the record.
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User", "id");
    }
}
