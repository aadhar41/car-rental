<?php

namespace App\Traits;

use App\Models\Vehicle;

trait AjaxTrait
{
    public function getbrandvehicles()
    {
        $count = Vehicle::where(["status" => "1", "brand_id" => $_POST['brand_id']])->count();
        if ($count > 0) {
            $vehicles = Vehicle::where(["status" => "1", "brand_id" => $_POST['brand_id']])->get()->toArray();
            return view('admin.ajax.brandvehicles', compact('vehicles'));
        } else {
            return view('admin.ajax.defaultbrandvehicles');
        }
    }
}
