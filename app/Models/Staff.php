<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // relationships
    public function massage_facility() {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }
}
