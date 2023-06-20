<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MassageService;
use App\Models\ServicePrice;

class MassageServiceController extends Controller
{
    public function store($service, $serviceImage, $masageFacility) {

        //Nhan thong tin va luu vao bang MassageService
        $massageService = MassageService::create([
            'facilityID' => $masageFacility->id,
            'serviceName' => $service->serviceName,
            'serviceDescription' => $service->serviceDescription,
            'availabilityStatus' => $service->availabilityStatus,
        ]);
        //Store File: path = "/public/massageService"
            // $service_id = $massageService->id;
            // $facility_id = $masageFacility->id;
            // $image = 'service_'.$service_id.'_avatar'.$req->file('image')->getClientOriginalExtension();
            // $massageService->image = $req->file('image')->store($service_id,'services');
        // if ($req->hasFile('image')) {
        //     $image = $req->file('image');
        //     $imageName = $massageService->id . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('public/messageService',$imageName);
        //     //Luu duong dan toi hinh anh
        //     $massageService->image = 'messageService/' . $imageName;
        //     $massageService->save();
        // }

        // Lưu ảnh và lấy đường dẫn lưu vào database
        $directory = 'massageServices/';
        $fileExtension = $serviceImage->getClientOriginalExtension();
        $fileName = $massageService->id . ".$fileExtension";
        $serviceImage->storeAs(
            $directory,
            $fileName,
            'public_uploads'
        );
        $massageService->imageURL = $directory . $fileName;
        $massageService->save();

        // Lưu thông tin giá vào bảng service_prices
        $servicePriceController = new ServicePriceController();

        if ($service->__isset('priceList') && !empty($service->priceList)){

            foreach ($service->priceList as $price) {
                $servicePriceController->store($massageService->id, $price);
            }
        }
    }
}
