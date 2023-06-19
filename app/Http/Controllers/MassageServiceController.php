<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MassageService;
use App\Models\ServicePrice;

class MassageServiceController extends Controller
{
    public function store(Request $req, $masageFacility) {

        //Nhan thong tin va luu vao bang MassageService        
        $massageService = MassageService::create([
            'facilityID' => $masageFacility->id,
            'serviceName' => $req->serviceName,
            'serviceDescription' => $req->serviceDescription,
            'availabilityStatus' => $req->availabilityStatus,
        ]);
        //Store File: path = "/public/massageService"
            // $service_id = $massageService->id;
            // $facility_id = $masageFacility->id;
            // $image = 'service_'.$service_id.'_avatar'.$req->file('image')->getClientOriginalExtension();
            // $massageService->image = $req->file('image')->store($service_id,'services');
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = $massageService->id . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/messageService',$imageName);
            //Luu duong dan toi hinh anh
            $massageService->image = 'messageService/' . $imageName;
            $massageService->save();
        }
        // lưu thông tin giá vào bảng service_prices
        $servicePriceController = new ServicePriceController();
        $servicePriceController->store($req);
        
        return response('ok');
    }
}
