<?php

namespace Database\Seeders;

use App\Models\MassageService;
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
        // Khi insert thêm dữ liệu thì "count" +1
        // Cần làm cách này để sử dụng afterCreate bên factory
        MassageService::factory()->count(35)->sequence(
            [
                'facilityID' => 1,
                'serviceName' => '感覚を目覚めさせて',
                'serviceDescription' => 'ハーブフットバス、角質除去、顔の若返り',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_01',
            ],
            [
                'facilityID' => 1,
                'serviceName' => '彼女の至福',
                'serviceDescription' => 'フローラルフットリチュアル、フルボディマッサージ、さわやかなボディスクラブ、活性化フェイシャル',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_02',
            ],
            [
                'facilityID' => 1,
                'serviceName' => '彼のためのストレス解消 ',
                'serviceDescription' => 'スチームバス、フルボディマッサージ、さわやかなボディスクラブ、ボディラップの至福',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_03',
            ],
            [ //Serene Summer Day
                'facilityID' => 1,
                'serviceName' => '静謐な夏の日',
                'serviceDescription' => 'スチームバス、アロマセラピー、ボディスクラブ',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_04',
            ],
            [ //Serene Winter Day
                'facilityID' => 1,
                'serviceName' => '静謐な冬の日',
                'serviceDescription' => 'スチームバス、静謐なオイル＆ホットストーンマッサージ、ボディラップ、エクスプレスフェイシャル',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_05',
            ],
            [ //Touch of Serene
                'facilityID' => 1,
                'serviceName' => '静謐なタッチ',
                'serviceDescription' => 'ハーブの深層筋肉セラピーを伴う浸浴槽、ボディスクラブ、フェイシャルケア',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_06',
            ],
            [ //Serene Sweet Couple
                'facilityID' => 1,
                'serviceName' => '静謐なスイートカップル',
                'serviceDescription' => 'カップル、牛乳と花のアロマセラピーを伴う浸浴槽、ボディスクラブ、フェイシャルケア',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_07',
            ],
            [ //Serene Experience
                'facilityID' => 1,
                'serviceName' => '静謐な体験',
                'serviceDescription' => 'ハーブと静謐なカッピングマッサージを伴う浸浴槽、ボディスクラブ、ボディラップ、フェイシャルケア',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_08',
            ],
            [ //Paradise of Serene
                'facilityID' => 1,
                'serviceName' => '静謐な楽園',
                'serviceDescription' => 'ミルクと花の浸浴槽、ハーブ蒸気浴、ラグジュアリーな4手ボディスクラブ、ボディラップ、コラーゲンで若返るフェイシャル',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_09',
            ],
            [ //Soothing Aroma Therapy
                'facilityID' => 1,
                'serviceName' => '穏やかなアロマセラピー',
                'serviceDescription' => 'スキンケアに加えて、100%天然オイルを使用したこのエッセンシャルオイルトリートメントは筋肉をリラックスさせ、血管の詰まりに関連する症状の予防や治療、体内の解毒を助けます。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_01_10',
            ],
            //facility 2: La Belle Vie Spa
            [ //La Belle Signature Package
                'facilityID' => 2,
                'serviceName' => 'ラ・ベル・シグネチャー・パッケージ',
                'serviceDescription' => 'オートミルク保湿ボディスクラブ、オートボディラップ、ハーバルスチーム、シグネチャーマッサージ、クラシックフェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_01',
            ],
            [ //La Belle Unique Package
                'facilityID' => 2,
                'serviceName' => 'ラ・ベル・ユニーク・パッケージ',
                'serviceDescription' => 'オートミルク保湿ボディスクラブ、オートボディラップ、ハーバルスチーム、シグネチャーバンブーマッサージ、贅沢フェイシャル（熟成肌用）、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_02',
            ],
            [ //Romantic Honeymoon Package (for couples)
                'facilityID' => 2,
                'serviceName' => 'ロマンティック・ハネムーン・パッケージ（カップル向け）',
                'serviceDescription' => 'グリーンティーボディスクラブ、ハーバルスチーム、ベトナムマッサージ、クラシックフェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_04',
            ],
            [ //Relaxation Package for her
                'facilityID' => 2,
                'serviceName' => 'リラクゼーションパッケージ（女性向け）',
                'serviceDescription' => 'ベトナムココナッツスクラブ、ココナッツボディラップ、ハーバルスチーム、ベトナムマッサージ、クラシックフェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_01',
            ],
            [ //Sprit of Vietnam
                'facilityID' => 2,
                'serviceName' => 'ベトナムの魂',
                'serviceDescription' => 'ベトナムココナッツスクラブ、ハーバルスチーム、バンブーマッサージ、贅沢フェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_02',
            ],
            [ //Romantic Honeymoon Luxury Package (for couples)
                'facilityID' => 2,
                'serviceName' => 'ロマンティック・ハネムーン・ラグジュアリー・パッケージ（カップル向け）',
                'serviceDescription' => 'グリーンティーボディスクラブ、デッドシー・デトックスボディラップ、ハーバルスチーム、フォー・ハンズ・マッサージ、贅沢フェイシャル（熟成肌用）、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_05',
            ],
            [ //Relaxation Package for him
                'facilityID' => 2,
                'serviceName' => 'リラクゼーションパッケージ（男性向け）',
                'serviceDescription' => 'デッドシーソルトボディスクラブ、ハーバルスチーム、バンブーマッサージ、クラシックフェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_06',
            ],
            [ //Aniversary Package (for couples)
                'facilityID' => 2,
                'serviceName' => 'アニバーサリーパッケージ（カップル向け）',
                'serviceDescription' => 'ラベル・ヴィユニークトリートメント、グリーンティーボディスクラブ、デッドシー・デトックスボディラップ、ハーバルスチーム、クラシックフェイシャル、アニバーサリーケーキ + 花とワインのセットアップ、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_02_01',
            ],
            //facility 3: L'essence spa
            [ //L'essence Signature Package
                'facilityID' => 3,
                'serviceName' => 'ラ・ベル・シグネチャー・パッケージ',
                'serviceDescription' => 'オートミルク保湿ボディスクラブ、オートボディラップ、ハーバルスチーム、シグネチャートリートメント、贅沢フェイシャル（熟成肌用）、ジャクジー/ハーバル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            [ //L'essence Unique Package
                'facilityID' => 3,
                'serviceName' => 'ラ・ベル・ユニーク・パッケージ',
                'serviceDescription' => 'オートミルク保湿ボディスクラブ、オートボディラップ、ハーバルスチーム、ユニークトリートメント、贅沢フェイシャル（熟成肌用）、ジャクジー/ハーバル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            [ //Romantic Honeymoon Package (for couples)
                'facilityID' => 3,
                'serviceName' => 'ロマンティック・ハネムーン・パッケージ（カップル向け）',
                'serviceDescription' => 'グリーンティーボディスクラブ、ハーバルスチーム、ベトナムマッサージ、クラシックフェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            [ //Relaxation Package for her
                'facilityID' => 3,
                'serviceName' => 'リラクゼーションパッケージ（女性向け）',
                'serviceDescription' => 'ベトナムココナッツスクラブ、ココナッツボディラップ、ハーバルスチーム、ベトナムマッサージ、クラシックフェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            [ //Sprit of Vietnam
                'facilityID' => 3,
                'serviceName' => 'ベトナムの魂',
                'serviceDescription' => 'ベトナムココナッツスクラブ、ハーバルスチーム、バンブーマッサージ、贅沢フェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            [ //Romantic Honeymoon Luxury Package (for couples)
                'facilityID' => 3,
                'serviceName' => 'ロマンティック・ハネムーン・ラグジュアリー・パッケージ（カップル向け）',
                'serviceDescription' => 'グリーンティーボディスクラブ、デッドシー・デトックスボディラップ、ハーバルスチーム、フォー・ハンズ・マッサージ、贅沢フェイシャル（熟成肌用）、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            [ //Relaxation Package for him
                'facilityID' => 3,
                'serviceName' => 'リラクゼーションパッケージ（男性向け）',
                'serviceDescription' => 'デッドシーソルトボディスクラブ、ハーバルスチーム、バンブーマッサージ、クラシックフェイシャル、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            [ //Aniversary Package (for couples)
                'facilityID' => 3,
                'serviceName' => 'アニバーサリーパッケージ（カップル向け）',
                'serviceDescription' => 'ラベル・ヴィユニークトリートメント、グリーンティーボディスクラブ、デッドシー・デトックスボディラップ、ハーバルスチーム、クラシックフェイシャル、アニバーサリーケーキ + 花とワインのセットアップ、食事の特典',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_03_01',
            ],
            //facility 4: La Spa
            [ //Pamper Package
                'facilityID' => 4,
                'serviceName' => 'リラックスパッケージ',
                'serviceDescription' => '温かく滑らかな石を使用したホットストーン全身マッサージと、リフレッシュ効果のあるフェイシャルの組み合わせです。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_04_01',
            ],
            [ //Cloud 9 Package
                'facilityID' => 4,
                'serviceName' => 'クラウド9パッケージ',
                'serviceDescription' => '温かい滑らかな石を使用したホットストーン全身マッサージに、心地よいフットスクラブを組み合わせたパッケージです。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_04_02',
            ],
            [ //Made for Life
                'facilityID' => 4,
                'serviceName' => 'メイド・フォー・ライフ',
                'serviceDescription' => 'この贅沢なフェイス＆フットリチュアルは、エネルギーフローを促し、毒素を排出し、顔の筋肉を引き締めるだけでなく、頭からつま先まで深く活力を与え、癒された感覚を促進します。日常生活から逃れてリラックスする絶好の機会です。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_04_03',
            ],
            [ //Blissful La Spa Day package
                'facilityID' => 4,
                'serviceName' => '至福のLa Spaデイパッケージ',
                'serviceDescription' => 'スチームバス、アロマセラピー、ボディスクラブ',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_04_01',
            ],
            [ //Four-hands Massage
                'facilityID' => 4,
                'serviceName' => 'フォーハンズマッサージ',
                'serviceDescription' => 'この施術は全身の最大限のリラクゼーションを促し、痛みや筋肉の緊張を緩和し、血液循環を改善し、気分を向上させます。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_04_02',
            ],
            //facility 5: omamori spa
            [ //Omamori non-oil
                'facilityID' => 5,
                'serviceName' => 'OMAMORI マッサージ(オイルなし)',
                'serviceDescription' => '指先をしっかり使い、 身体を温め、 心と身体を健康へと導くために、 身体のエネルギーと 身体内部を調整していく古代東洋のベトナム 式トリートメントです。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_05_06',
            ],
            [ //Hot stone
                'facilityID' => 5,
                'serviceName' => 'ホットストーンマッサージ',
                'serviceDescription' => '温められたアロマストーンにより、緊張を和 らげ、筋肉の硬直を緩和し、 ストレスを軽減 させて深いリラゼーションへと導きます。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_05_07',
            ],
            [ //Zen in heart
                'facilityID' => 5,
                'serviceName' => '"禅"イン・ザ・ハートトリートメント',
                'serviceDescription' => '一流のセラピスト達により、 彼らの魔法のよう な手と献身的な心によってあなたに完璧なる体 験をお届けすることができる特別なトリートメ ントです。 セラピストはあなたの身体の状態に 応じて4つの異なる技法を組み合わせ、 あなた をリラクゼーションへと導きます。',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_05_08',
            ],
            [ //Eternal energy
                'facilityID' => 5,
                'serviceName' => 'エターナル・エナジー',
                'serviceDescription' => '2人の一流のセラピストによりあなたをリラクゼーションの旅へと導きます。 あなたのために選び 調合した当別なオイルを使って、 足の疲労を緩和 することから施術は始ります。 施術には宇宙の第 4元素である、 土・火・水・空気を組み合わせる 技法が用いられ、 あなたの身体全体に完全なる調和をもたらします',
                'availabilityStatus' => 1,
                'imageURL' => 'img/img_service/img_service_05_09',
            ],
            // Them nhu tren luong oi
        )->create();
    }
}
