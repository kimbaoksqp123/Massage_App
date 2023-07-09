<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MassageService;
use App\Models\ServicePrice;
use Illuminate\Support\Facades\Storage;

class MassageServiceController extends Controller
{
    public function store($service, $masageFacility) {

        // Lấy thông tin service, lưu vào bảng massage_services
        $massageService = MassageService::create([
            'facilityID' => $masageFacility->id,
            'serviceName' => $service['serviceName'],
            'serviceDescription' => $service['serviceDescription'],
            'availabilityStatus' => 1,
        ]);

        // Lưu ảnh và lấy đường dẫn lưu vào database
        $serviceImage = $service['serviceImg'];

        $directory = 'massageServices/';
        $fileExtension = $serviceImage->getClientOriginalExtension();
        $fileName = $massageService->id . ".$fileExtension";

        $pathImageS3 = 'uploads/' . $directory . $fileName;
        $serviceImage->storeAs($directory, $fileName, 'public_uploads');
        $path = Storage::disk('s3')->put($pathImageS3, file_get_contents($serviceImage));
        $path = Storage::disk('s3')->url($path);

        $massageService->imageURL = 'uploads/' . $directory . $fileName;
        $massageService->save();

        // Lưu thông tin giá vào bảng service_prices
        $servicePriceController = new ServicePriceController();

        if (isset($service['priceList']) && !empty($service['priceList'])) {

            foreach ($service['priceList'] as $price) {
                $servicePriceController->store($massageService->id, $price);
            }
        }
    }
}
