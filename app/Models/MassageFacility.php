<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageFacility extends Model
{
    use HasFactory;
    protected $table = 'massage_facilitys';
    protected $primaryKey = 'id'; 
    public $timestamps = false;
    protected $fillable = [
        'ownerId',
        'name',
        'description',
        'location',
        'imageURL',
        'phoneNumber',
        'emailAddress',
        'capacity',
        'averageRating'
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'ownerID', 'id');
    }

    public function massage_services()
    {
        return $this->hasMany(MassageService::class, 'facilityID', 'id');
    }

    public function image_librarys()
    {
        return $this->hasMany(ImageLibrary::class, 'facilityID', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'facilityID', 'id');
    }

}
