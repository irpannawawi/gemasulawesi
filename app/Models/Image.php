<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $primaryKey = 'image_id';
    public $fillable = [
        'image_id',
        'asset_id',
        'uploader_id',
        'author',	
        'caption',	
        'credit',	
        'source',	
        'image_sc_type',	
    ];

    public function asset(): HasOne
    {
        return $this->hasOne(Asset::class, 'asset_id', 'asset_id');
    }

    public function uploader(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'uploader_id');
    }
}
