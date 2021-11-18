<?php

namespace App\Traits;



trait StatusTrait
{
    public function scopeActive($query)
    {
        return $query->where("status", "1");
    }

    public function scopeInactive($query)
    {
        return $query->where("status", "0");
    }
}
