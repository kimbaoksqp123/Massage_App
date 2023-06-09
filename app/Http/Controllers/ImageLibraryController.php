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

        if (!Storage::disk('public_uploads')->exists($url)) {
            Storage::disk('public_uploads')->makeDirectory($url);
        }

        if ($req->__isset('imageLibrary')) {
            $imageLibraryFiles = $req->file('imageLibrary');
        }

        if (!empty($imageLibraryFiles)) {

            $count = 0;
            foreach ($imageLibraryFiles as $file) {

                // Lưu file vào storage
                $formatFile = $file->getClientOriginalExtension();
                $file->storeAs($url, $count + 1 . ".$formatFile", 'public_uploads');

                $pathImageS3 = 'uploads/' . $url . $count + 1 . ".$formatFile";
                $path = Storage::disk('s3')->put($pathImageS3, file_get_contents($file));
                $path = Storage::disk('s3')->url($path);

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
}
