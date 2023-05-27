<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLibrary extends Model
{
    use HasFactory;
    protected $table = 'image_librarys';
    protected $primaryKey = 'id'; 
    public $timestamps = false;
    protected $fillable = [
        'ficilityID',
        'imageURL',
        
    ];
    public function massage_facility()
    {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }

   

}
