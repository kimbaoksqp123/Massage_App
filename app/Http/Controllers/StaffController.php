<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\MassageFacility ;
class StaffController extends Controller
{

    public function store($staff_request, $massage_facility) {
        $massage_facility->staffs = $massage_facility->staffs->create(
            [
                'name' => $staff_request->name,
                'dob'  => $staff_request->dob,
                'gender'  => $staff_request->gender,
                'jlpt'  => $staff_request->jlpt,
                'certificateImage' => $staff_request->certificateImage->store('staffs'),
                'image'  => $staff_request->image->store('staffs'),
                'hometown'  => $staff_request->hometown,
            ]
            );        
        //Chạy lệnh php artisan storage:link để tạo liên kết tới thư mục lưu trữ

        }
}
