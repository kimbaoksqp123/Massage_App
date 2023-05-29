<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MassageServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('massage_services')->insert([
            [
                'facilityID' => 1,
                'serviceName' => '感覚を目覚めさせて',
                'serviceDescription' => 'ハーブフットバス、角質除去、顔の若返り',
                'price' => 1380000,
                'availabilityStatus'=> 1,
                'imageURL' => 'img/img_service/img_service_01_01',
                'serviceDuration' => 120,
            ],
        
                // Them nhu tren luong oi
            
        ]);
    }
}
