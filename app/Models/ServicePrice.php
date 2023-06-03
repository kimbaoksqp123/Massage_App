<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    use HasFactory;
    protected $table = 'service_prices';
    protected $primaryKey = 'id'; 
    public $timestamps = false;
    protected $fillable = [
        'serviceID',
        'price',
        'durationTime'             
    ];
    public function massage_service()
    {
        return $this->belongsTo(MassageService::class, 'serviceID', 'id');
    }
}
