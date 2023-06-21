<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicePrice;
use App\Models\MassageService;

class ServicePriceController extends Controller
{
    public function store($massageServiceId, $price) {
        ServicePrice::create([
            'serviceID' => $massageServiceId,
            'price' => $price['price'],
            'durationTime' => $price['duration'],
        ]);
    }
}
