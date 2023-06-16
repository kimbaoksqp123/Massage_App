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
    public function store($massageFacilityId, $imageLibararys)
    {
        for ($i = 0; $i < count($imageLibararys); $i++) {
            $data[] = [
                'facilityID' => $massageFacilityId,
                'imageURL' => $imageLibararys[$i],
            ];
        }

        ImageLibrary::insert($data);
    }
}
