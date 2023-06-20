<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageFacility extends Model
{
    use HasFactory;
    protected $table = 'massage_facilitys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ownerID',
        'name',
        'description',
        'location',
        'phoneNumber',
        'emailAddress',
        'capacity',
        'averageRating',
        'staffNumber',
        'isActive',
    ];

    // add custom attribute to array & json
    protected $appends = ['review_count', 'image_url'];

    // accessors
    protected function reviewCount(): CastsAttribute {

        return new CastsAttribute(
            get: fn () => $this->ratings()->count(),
        );
    }

    protected function imageUrl(): CastsAttribute {

        return new CastsAttribute(
            get: fn () => $this->image_librarys()->first()->imageURL,
        );
    }

    // relationships
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

    public function staffs() {
        return $this->hasMany(Staff::class, 'facilityID', 'id');
    }

    public function create_request() {
        return $this->hasOne(CreateRequest::class, 'facilityID', 'id');
    }
}
