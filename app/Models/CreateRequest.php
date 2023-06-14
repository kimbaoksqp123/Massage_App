<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateRequest extends Model
{
    use HasFactory;
    protected $table = 'create_requests';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // relationships
    public function massage_facility() {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
