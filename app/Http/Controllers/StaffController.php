<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\MassageFacility ;
class StaffController extends Controller
{

    public function store($staff_request, $massage_facility) {
        $staff = $massage_facility->staffs->create(
            [
                'name' => $staff_request->name,
                'dob'  => $staff_request->dob,
                'gender'  => $staff_request->gender,
                'jlpt'  => $staff_request->jlpt,
                // 'certificateImage' => $staff_request->certificateImage->store('staffs'),
                // 'image'  => $staff_request->image->store('staffs'),
                'hometown'  => $staff_request->hometown,
            ]
            );        
        //Chạy lệnh php artisan storage:link để tạo liên kết tới thư mục lưu trữ
        //Lay ra id staff
        $staff_id = $staff->id;
        //Rename Filename : Staff_{id}_certificate
        $certificateImage = 'Staff_'.$staff_id.'_certificate'.$staff_request->file('certificateImage')->getClientOriginalExtension();
        //Store File : path = "app/public/staffs/{id}"
        $staff->certificateImage = $staff_request->file('certificateImage')->store($staff_id,'staffs');
        $image = 'staff_'.$staff_id.'_avatar'.$staff_request->file('image')->getClientOriginalExtension();
        $staff->image = $staff_request->file('image')->store($staff_id,'staffs');
        $staff->save();
        }
}
