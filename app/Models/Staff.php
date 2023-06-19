<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'dob','facilitiID','gender','jlpt','certificateImage','image','hometown','created_at'];
    public $timestamps = false;

    // relationships
    public function massage_facility() {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }
}
