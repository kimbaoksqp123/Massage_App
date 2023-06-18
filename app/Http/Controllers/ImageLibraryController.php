<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageLibrary;
use App\Models\MassageFacility;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageLibraryController extends Controller
{
    public function store($massageFacility, $imageLibararys)
    {
        for ($i = 0; $i < count($imageLibararys); $i++) {
            $data[] = [
                'facilityID' => $massageFacility->id,
                'imageURL' => "$massageFacility->id_$imageLibararys[$i]",
            ];

            // Tạo đường dẫn trong thư mục Storage/app/public/imageFacilities/{id của quán}/base (base để lưu ảnh của quán)
            // Storage::makeDirectory("public/imageFacilities/$massageFacility->id/base");
            // anh(file) ->  storeAs('url', imageName);
            // $imageLibararys[$i]->storeAs("images/$massageFacility->id/base", "$massageFacility->id_$imageLibararys[$i]");
        }

        $massageFacility->image_librarys()->insert($data);
    }
}
