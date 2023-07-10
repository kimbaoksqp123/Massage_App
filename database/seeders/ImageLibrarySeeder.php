<?php

namespace Database\Seeders;

use App\Models\MassageFacility;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilityIds = MassageFacility::limit(5)->pluck('id')->toArray();

        DB::table('image_librarys')->insert([
            [
                'facilityID' => $facilityIds[0],
                'imageURL' => 'img/img_01_01.jpg',
            ],
            [
                'facilityID' => $facilityIds[0],
                'imageURL' => 'img/img_01_02.jpg',
            ],
            [
                'facilityID' => $facilityIds[0],
                'imageURL' => 'img/img_01_03.jpg',
            ],
            [
                'facilityID' => $facilityIds[0],
                'imageURL' => 'img/img_01_04.jpg',
            ],
            [
                'facilityID' => $facilityIds[1],
                'imageURL' => 'img/img_02_01.jpg',
            ],
            [
                'facilityID' => $facilityIds[1],
                'imageURL' => 'img/img_02_02.jpg',
            ],
            [
                'facilityID' => $facilityIds[1],
                'imageURL' => 'img/img_02_03.jpg',
            ],
            [
                'facilityID' => $facilityIds[1],
                'imageURL' => 'img/img_02_04.jpg',
            ],
            [
                'facilityID' => $facilityIds[2],
                'imageURL' => 'img/img_03_01.jpg',
            ],
            [
                'facilityID' => $facilityIds[2],
                'imageURL' => 'img/img_03_02.jpg',
            ],
            [
                'facilityID' => $facilityIds[2],
                'imageURL' => 'img/img_03_03.jpg',
            ],
            [
                'facilityID' => $facilityIds[2],
                'imageURL' => 'img/img_03_04.jpg',
            ],
            [
                'facilityID' => $facilityIds[3],
                'imageURL' => 'img/img_04_01.jpg',
            ],
            [
                'facilityID' => $facilityIds[3],
                'imageURL' => 'img/img_04_02.jpg',
            ],
            [
                'facilityID' => $facilityIds[3],
                'imageURL' => 'img/img_04_03.jpg',
            ],
            [
                'facilityID' => $facilityIds[3],
                'imageURL' => 'img/img_04_04.jpg',
            ],
            [
                'facilityID' => $facilityIds[4],
                'imageURL' => 'img/img_05_01.jpg',
            ],
            [
                'facilityID' => $facilityIds[4],
                'imageURL' => 'img/img_05_02.jpg',
            ],
            [
                'facilityID' => $facilityIds[4],
                'imageURL' => 'img/img_05_03.jpg',
            ],
        ]);
    }
}
