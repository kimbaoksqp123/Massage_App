<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\MassageFacility ;
use DateTime;
use Illuminate\Support\Carbon;

class StaffController extends Controller
{

    public function store($staff_request, $massage_facility) {
        $staff = Staff::create(
            [
                'facilityID' => $massage_facility->id,
                'name' => $staff_request['name'],
                'dob'  => Carbon::createFromFormat('d/m/Y', $staff_request['DOB']),
                'gender'  => $staff_request['gender'],
                'jlpt'  => $staff_request['jlpt'],
                'hometown'  => $staff_request['hometown'],
               
            ]
            );        
        //Chạy lệnh php artisan storage:link để tạo liên kết tới thư mục lưu trữ
        //Lay ra id staff
        $staff_id = $staff->id;
        //Rename Filename : Staff_{id}_certificate
        $certificateImage = 'Staff_'.$staff_id.'_certificate.'.$staff_request['certificateImage']->getClientOriginalExtension();
        // //Store File : path = "app/public/staffs/{id}"
        $image = 'Staff_'.$staff_id.'_avatar.'.$staff_request['image']->getClientOriginalExtension();
        // $staff->image = $staff_request->file('image')->store($staff_id,'staffs');
        $url = "staffs/$staff_id";
        // $formatFile = $staff_request['certificateImage']->getClientOriginalExtension();
        $staff->certificateImage = $staff_request['certificateImage']->storeAs($url,$certificateImage,'public_uploads');
        $staff->image = $staff_request['image']->storeAs($url,$image,'public_uploads');
        $staff->certificateImage = 'uploads/' . $staff->certificateImage;
        $staff->image = 'uploads/' . $staff->image;
        $staff->save();
    }
}
