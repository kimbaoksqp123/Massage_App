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
                'imageURL' => $imageLibararys[$i],
            ];
        }

        $massageFacility->image_librarys()->insert($data);
    }
}
