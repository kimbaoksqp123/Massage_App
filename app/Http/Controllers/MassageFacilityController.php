<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MassageFacilityResource;
use App\Models\MassageFacility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class MassageFacilityController extends Controller
{
    public function index() {
        return MassageFacilityResource::collection(MassageFacility::all());
    }

    public function filter(Request $req) {

        // get request data
        $input = $req->input;
        $serviceList = array($req->serviceList);
        $minPrice = $req->minPrice;
        $maxPrice = $req->maxPrice;
        $minRate = $req->minRate;
        $maxRate = $req->maxRate;

        // instantiate query
        $query = MassageFacility::query();
        
        // name, address
        if ($input) {

            $inputWithSpaces = trim($input);
            $inputWithoutSpaces = preg_replace('/\s+/', '', $input);
            
            $nameWithoutSpaces = "REPLACE(REPLACE(REPLACE(name, ' ', ''), '\t', ''), '\n', '')";
            $locationWithoutSpaces = "REPLACE(REPLACE(REPLACE(location, ' ', ''), '\t', ''), '\n', '')";

            $subQuery = MassageFacility::selectRaw("
                id,
                $nameWithoutSpaces as nameWithoutSpaces,
                $locationWithoutSpaces as locationWithoutSpaces
            ");

            $query->joinSub($subQuery, 'sub_query', function (JoinClause $join) {
                $join->on('massage_facilitys.id', '=', 'sub_query.id');
            })
                ->whereRaw("TRIM(name) LIKE ?", ['%' . $inputWithSpaces . '%'])
                ->orWhereRaw("TRIM(location) LIKE ?", ['%' . $inputWithSpaces . '%'])
                ->orWhereRaw("nameWithoutSpaces LIKE ?", ['%' . $inputWithoutSpaces . '%'])
                ->orWhereRaw("locationWithoutSpaces LIKE ?", ['%' . $inputWithoutSpaces . '%']);
        }

        // massage service
        if (count($serviceList) > 0 && !empty($serviceList[0]) ) {
            $query->with('massage_services')
                ->whereHas('massage_services', function (Builder $query) use ($serviceList) {
                    $query->whereIn('serviceName', $serviceList);
                });
        }

        // price
        if ($minPrice && $maxPrice) {

        }

        // rate
        if ($minRate && $maxRate) {

        }

        return MassageFacilityResource::collection($query->get());
    }
}
