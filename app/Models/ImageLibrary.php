<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLibrary extends Model
{
    use HasFactory;
    protected $table = 'image_librarys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'facilityID',
        'imageURL',
    ];

    // relationships
    public function massage_facility()
    {
        return $this->belongsTo(MassageFacility::class, 'facilityID', 'id');
    }
}
