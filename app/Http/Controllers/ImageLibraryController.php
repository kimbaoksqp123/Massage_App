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

        $count = 0;
        foreach ($imageLibrary->file('files') as $obj) {
            // Lưu ảnh vào storage
            $formatFile =  $obj->image->getClientOriginalExtension();
            $obj->image->storeAs($url, $count + 1 . ".$formatFile");

            // Tạo data để thực hiện câu query
            $data[] = [
                'facilityID' => $massageFacility->id,
                'imageURL' => $count + 1 . ".$formatFile",
            ];
        }

        // foreach ($imageLibrary->file('files') as $file) {
        //     $file->storeAs(
        //         'public/staffs/{id}/',
        //         'aabcasdsa'
        //     );
        // }

        $massageFacility->image_librarys()->insert($data);
    }
}
