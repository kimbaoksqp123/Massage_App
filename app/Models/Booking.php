<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'id'; 
    // public $timestamps = false;
    protected $fillable = [
        'serviceID',
        'userID',
        'bookingStatusID',
        'numberOfCustomer',
        'totalPrice',
        'created_at',
        'updated_at',               
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function massage_facility()
    {
        return $this->belongsTo(MassageService::class, 'serviceID', 'id');
    }

}
