<?php

namespace Database\Seeders;

use App\Models\MassageFacility;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->pluck('id')->toArray();
        $facilityIds = MassageFacility::all()->pluck('id')->toArray();

        DB::table('ratings')->insert([
            [
                'userID' => Arr::random($userIds),
                'facilityID' => Arr::random(($facilityIds)),
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => Arr::random($userIds),
                'facilityID' => Arr::random(($facilityIds)),
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => Arr::random($userIds),
                'facilityID' => Arr::random(($facilityIds)),
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => Arr::random($userIds),
                'facilityID' => Arr::random(($facilityIds)),
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => Arr::random($userIds),
                'facilityID' => Arr::random(($facilityIds)),
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => Arr::random($userIds),
                'facilityID' => Arr::random(($facilityIds)),
                'comment' => '楽しかったし、とてもリラックスできました！受付係のアイビーさんは流暢な日本語を話し、はっきりと話しかけてくれます。マッサージ師さんの態度も技術も素晴らしいです！',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => Arr::random($userIds),
                'facilityID' => Arr::random(($facilityIds)),
                'comment' => 'セラピストはとても素敵で、よく訓練されています。 ここではリラックスできるカッピングマッサージを楽しんでいます。 サービスはプロフェッショナルです。',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
