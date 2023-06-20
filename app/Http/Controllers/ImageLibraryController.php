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
    public function store($req, $massageFacility)
    {
        $url = "massageFacilities/$massageFacility->id/";
        $count = 0;

        foreach ($req->file('imageLibrary') as $file) {

            // Lưu file vào storage
            $formatFile = $file->getClientOriginalExtension();
            $file->storeAs($url, $count + 1 . ".$formatFile", 'public_uploads');

            // Tạo data để thực hiện câu query
            $data[] = [
                'facilityID' => $massageFacility->id,
                'imageURL' => 'uploads/' . $url . $count + 1 . ".$formatFile",
            ];

            $count++;
        }

        $massageFacility->image_librarys()->insert($data);
    }
}
