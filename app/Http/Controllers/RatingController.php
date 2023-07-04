<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Unset_;

class RatingController extends Controller
{
    private const PER_PAGE = 3; // 1 trang 3 bản ghi

    public function index($facilityID, $page = 1) {

        // lấy comment
        $ratings = Rating::with('user')
            ->where('facilityID', $facilityID)
            ->orderBy('created_at', 'desc')
            ->forPage($page, self::PER_PAGE)
            ->get([
                'id AS ratingId',
                'userID',
                'comment',
                'commentVoteup AS rate'
            ]);

        // lấy tổng số comment
        $ratingCount = Rating::where('facilityID', $facilityID)->count();

        // thêm thông tin user
        foreach ($ratings as $rating) {
            $rating['userName'] = $rating->user->username;
            $rating['userAvatarUrl'] = $rating->user->avatarImageUrl;
            unset($rating['userID']);
            unset($rating['user']);
        }

        // trả về
        return [
            'ratingList' => $ratings,
            'review_count' => $ratingCount
        ];
    }

    public function store(Request $req) {

        // lấy thông tin
        $facilityID = $req->shopId;
        $userID = $req->user()->id;
        $comment = $req->comment;
        $commentVoteup = $req->rate;

        // lưu vào DB
        $rating = new Rating();

        $rating->facilityID = $facilityID;
        $rating->userID = $userID;
        $rating->comment = $comment;
        $rating->commentVoteup = $commentVoteup;

        if ($rating->save()) {
            return response('ok');
        } else {
            return response('can not store to database', 500);
        }
    }
}
