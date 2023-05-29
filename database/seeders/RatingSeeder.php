<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'userID' => 1,
                'facilityID' => 1,
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => 1,
                'facilityID' => 2,
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => 1,
                'facilityID' => 3,
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => 1,
                'facilityID' => 4,
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => 1,
                'facilityID' => 5,
                'comment' => '素晴らしい！！！ このサービスはすごいですね！！！ プロの対応、 機会があれば間違いなく戻ってきます',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => 2,
                'facilityID' => 1,
                'comment' => '楽しかったし、とてもリラックスできました！受付係のアイビーさんは流暢な日本語を話し、はっきりと話しかけてくれます。マッサージ師さんの態度も技術も素晴らしいです！',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
            [
                'userID' => 3,
                'facilityID' => 1,
                'comment' => 'セラピストはとても素敵で、よく訓練されています。 ここではリラックスできるカッピングマッサージを楽しんでいます。 サービスはプロフェッショナルです。',
                'commentVoteup' => 0,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
