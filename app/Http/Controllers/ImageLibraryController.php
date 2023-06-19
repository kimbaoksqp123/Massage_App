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
    public function store($massageFacility, $req)
    {
        $url = "public/imageFacilities/$massageFacility->id/";

        if (!Storage::exists($url)) {
            Storage::makeDirectory($url);
        }

        $count = 0;
        // foreach ($imageLibrary as $obj) {
        //     // Lưu ảnh vào storage
        //     $formatFile = $obj['image']->file()->getClientOriginalExtension();
        //     $obj['image']->file()->storeAs($url, $count + 1 . ".$formatFile");

        //     // Tạo data để thực hiện câu query
        //     $data[] = [
        //         'facilityID' => $massageFacility->id,
        //         'imageURL' => $count + 1 . ".$formatFile",
        //     ];
        // }

        foreach ($req->file('imageLibrary') as $file) {
            $formatFile = $file->getClientOriginalExtension();
            $file->storeAs($url, $count + 1 . ".$formatFile");

            // Tạo data để thực hiện câu query
            $data[] = [
                'facilityID' => $massageFacility->id,
                'imageURL' => $count + 1 . ".$formatFile",
            ];

            $count++;
            // $file->storeAs(
            //     'public/staffs/{id}/',
            //     'aabcasdsa'
            // );
        }

        $massageFacility->image_librarys()->insert($data);
    }
}
