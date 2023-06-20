<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateRequest extends Model
{
    use HasFactory;
    protected $table = 'create_requests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'facilityID',
        'userID',
        'requestStatus',
        'createdDate',
    ];

    // relationships
    public function massage_facility() {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
