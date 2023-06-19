<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicePrice;
use App\Models\MassageService;

class ServicePriceController extends Controller
{
    public function store(Request $req, MassageService $massageService) {
        $servicePrice = ServicePrice::create([
            'serviceID' => $massageService->id,
            'price' => $req->price,
            'durationTime' => $req->durationTime,
        ]);

        return response('ServicePriceControllerOk');
    }
}
