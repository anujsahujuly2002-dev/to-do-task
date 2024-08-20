<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'sub_title',
        'alias',
        'facilities_id',
        'tag_id',
        'destination_id',
        'class',
        'phone',
        'email',
        'website',
        'address',
        'latitude',
        'longitude',
        'description',
        'release',
        'home_page',
    ];

    public function destination() {
        return $this->belongsTo(Destination::class,'destination_id');
    }
}
