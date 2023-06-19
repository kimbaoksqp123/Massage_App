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
    public function store($massageFacility, $imageLibrary)
    {
        $url = "public/imageFacilities/$massageFacility->id/";

        if (!Storage::exists($url)) {
            Storage::makeDirectory($url);
        }

        for ($i = 0; $i < count($imageLibrary); $i++) {

            // Lưu ảnh vào storage
            $formatFile =  $imageLibrary[$i]->file('image')->getClientOriginalExtension();
            $imageLibrary[$i]->file('image')->storeAs($url, "$i" + 1 . ".$formatFile");

            // Tạo data để thực hiện câu query
            $data[] = [
                'facilityID' => $massageFacility->id,
                'imageURL' => "$i" + 1 . ".$formatFile",
            ];
        }

        $massageFacility->image_librarys()->insert($data);
    }
}
