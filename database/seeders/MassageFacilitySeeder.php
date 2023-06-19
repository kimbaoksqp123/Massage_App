<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MassageFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('massage_facilitys')->insert([
            [
                'id' => 1,
                'ownerId' => 1,
                'name' => 'Serene Spa',
                'description' => 'Serene Spa では、天然ハーブ療法と、何世代にもわたって受け継がれてきた古代の伝統を使用し、クライアントが当然のケアと配慮を受けられるようにしています。 スパには、多数のプライベート ルーム、特別なスイート、最新のハイドロ スペシャリストとトリートメント施設が備わっています。 マッサージセラピストによる丁寧なケアをお楽しみください。',
                'location' => '68 Ma May, Hoan Kiem, Hanoi, Vietnam',
                'phoneNumber' => '+84 916362368',
                'emailAddress' => 'info@serenespa.vn',
                'capacity' => 100,
                'averageRating' => 4.5,
                // 'created_at' => '1/2/3',
                // // 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ],

            [
                'id' => 2,
                'ownerId' => 2,
                'name' => 'La Belle Vie Spa',
                'description' => 'ラベラスパ グループは、東洋の最高の技術とベトナムのハーブのノウハウを調和させたトリートメントで、ユニークなスパ体験を提供します。 私たちの特別なスパでのすべての特別なトリートメントは、これまでにない最高の体験と感覚です。ラベルスパグループで、調和と純粋さの中でリラックスしてください。 プライベートトリートメントルームで最高のサービスをお楽しみください。',
                'location' => '46B Luong Van Can, Hoan Kiem, Hanoi, Vietnam',
                'phoneNumber' => '+84 2466869163',
                'emailAddress' => 'hanoilabelleviespa@gmail.com',
                'capacity' => 100,
                'averageRating' => 4.9,
            ],

            [
                'id' => 3,
                'ownerId' => 3,
                'name' => "Lessence Spa",
                'description' => 'レセンススパは、繊細でエレガントで優しい建築の中に静寂が支配する、完全なリラクゼーションのために作られました。',
                'location' => '36 Dinh Liet, Hoan Kiem, Hanoi, Vietnam',
                'phoneNumber' => '+84 978392399',
                'emailAddress' => 'booking@lessencespacom',
                'capacity' => 50,
                'averageRating' => 5,
            ],

            [
                'id' => 4,
                'ownerId' => 4,
                'name' => 'LA Spa',
                'description' => 'ホテル隣のプライベートビル内にあるラ シエスタ スパでは、リラックスしたひとときをお過ごしいただけます。 6 室のトリートメント ルームと、サウナやハーブバスなどのさまざまなトリートメントを備えており、どなたにもご満足いただけるものをご用意しております。',
                'location' => '94 P. Ma May, Hang Buom, Hoan Kiem, Hanoi, Vietnam',
                'phoneNumber' => '+84 2835354461',
                'emailAddress' => 'mamay@laspas.vn',
                'capacity' => 60,
                'averageRating' => 4.9,
            ],

            [
                'id' => 5,
                'ownerId' => 5,
                'name' => 'Omamori Spa Ha Noi',
                'description' => 'オマモリ スパは、2013 年に設立されたブラインドリンクによって設立および運営されているマッサージ センターのチェーンです。ブラインドリンクは、ベトナムの視覚障害者コミュニティ全般にウェルネスの分野でトレーニングの機会を提供する、社会的影響を与える先駆的な組織です。 BlindLink の目的は、この価値ある市民のグループにより良い生活水準とより高い自尊心を生み出すことです。',
                'location' => '48 Ngo Huyen , Old Quarter , Ha Noi , Vietnam',
                'phoneNumber' => '+84 969825494',
                'emailAddress' => 'booking@omamorispa.com',
                'capacity' => 100,
                'averageRating' => 4.8,
            ],
        ]);
        //
    }
}
