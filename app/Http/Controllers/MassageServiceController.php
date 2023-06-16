<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MassageServiceController extends Controller
{
    public function store(Request $req) {

        $servicePriceController = new ServicePriceController();
        
        //todo lưu thông tin service vào bảng massage_services

        // lưu thông tin giá vào bảng service_prices
        $servicePriceController->store($req);
    }
}
