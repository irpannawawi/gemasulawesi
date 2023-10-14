<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'gallery_collection';

    protected $primaryKey = 'collection_id';
    public $fillable = [
        'galery_id',
        'file_id',	
        'type',	
    ];

    public function photo(): HasOne
    {
        return $this->hasOne(Image::class, 'image_id', 'file_id');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'file_id', 'image_id');
    }

    public function video(): HasOne
    {
        return $this->hasOne(Video::class, 'video_id', 'file_id');
    }
}
