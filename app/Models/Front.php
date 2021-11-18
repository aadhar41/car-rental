<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class Front extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'fronts';

    public function abouturl()
    {
        return url('/images/about/') . "/";
    }
}
