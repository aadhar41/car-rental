<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class Unit extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'units';
}
