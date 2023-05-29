<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageService extends Model
{
    use HasFactory;
    protected $table = 'massage_services';
    protected $primaryKey = 'id'; 
    public $timestamps = false;
    protected $fillable = [
        'facilityID',
        'serviceName',
        'serviceDescription',
        'price',
        'availabilityStatus',
        'imageURL',
        'serviceDuration',               
    ];
    public function massage_facility()
    {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'serviceID', 'id');
    }

}
