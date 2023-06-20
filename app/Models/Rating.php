<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'userID',
        'facilityID',
        'comment',
        'commentVoteup',          
    ];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function massage_facility()
    {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }

}
